<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CouponController extends Controller
{
    protected $notFoundMessage = "Coupon not found!";
    // List coupons
    public function index()
    {
        $coupons = Coupon::select('id','code','brand_id','status','redeemed_at')
                    ->with(['brand:id,name'])->get();
        return response()->json([
            'status' => 200,
            'message' => !empty($coupons) ? "Coupons Listed Successfully" : "No coupon found",
            'coupons' => $coupons
        ]);
    }

    // Add new coupon
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:coupons|max:15',
            'brand_id' => 'required|exists:brands,id'
        ]);

        $coupon = Coupon::create($validatedData);
        return response()->json([
            'status' => 201,
            'message' => 'Coupon created successfully.',
            'coupon' => $this->getCoupon($coupon)
        ], 201);
    }

    // show coupon detail
    public function show($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);            
            return response()->json($this->getCoupon($coupon));
        } catch (\Throwable $th) {
            return response()->json(['status' => 404,'error' => $this->notFoundMessage], 404);
        }
    }

    // update coupon
    public function update(Request $request, $id)
    {
        try {
            $coupon = Coupon::findOrFail($id); 
            $validatedData = $request->validate([
                'code' => [
                    'required',
                    Rule::unique('coupons')->ignore($coupon->id),
                    'max:15',
                ],
                'brand_id' => 'required|exists:brands,id'
            ]);
    
            $coupon->update($validatedData);

            return response()->json([
                'status' => 200,
                'message' => 'Coupon updated successfully.',
                'coupon' => $this->getCoupon($coupon)
            ], 200);

        } catch (\Throwable $th) {
            return response()->json(['status' => 500,'error' => $th->getMessage()], 500);
        }
    }

    // delete coupon
    public function destroy($id)
    {
        try {
            $coupon = Coupon::findOrFail($id); 
            $coupon->delete();

            return response()->json(['status' => 200, 'message' => 'Coupon deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500,'error' => $th->getMessage()], 500);
        }        
    }

    // reedem coupon
    public function redeemCoupon(Request $request)
    {
        $validatedData = $request->validate([
            'code' => [
                'required',
                'max:15',
            ],
            'brand_id' => 'required|exists:brands,id'
        ]);
        
        try {
            // get the coupon record
            $coupon = Coupon::where('code', $request->code)
                            ->where('brand_id', $request->brand_id)
                            ->firstOrFail();
            
            // Check if the coupon has already been redeemed
            if ($coupon->status === 'redeemed') {
                return response()->json(['error' => 'Coupon already redeemed!'], 409);
            }

            // mark the coupon as redeemed along with time
            $coupon->status = 1;
            $coupon->redeemed_at = date('Y-m-d H:i:s');
            $coupon->save();
    
            return response()->json([
                'message' => 'Coupon redeemed successfully',
                'coupon' => $this->getCoupon($coupon)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 404,'error' => $this->notFoundMessage], 404);
        }
    }

    // to get the coupon details along with brand
    protected function getCoupon($coupon) 
    {
        if (!$coupon)
            return ['message' => $this->notFoundMessage];
        $coupon->load(['brand' => function($query) {
            $query->select('id', 'name');
        }]);
        $couponData = $coupon->only(['id', 'code', 'status','redeemed_at']);
        $couponData['brand'] = $coupon->brand->only(['id', 'name']);

        return $couponData ?? ['message' => $this->notFoundMessage];
    }
}
