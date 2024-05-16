<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'brand_id', 'status', 'redeemed_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function getStatusAttribute($value)
    {
        $statusLabels = [
            0 => 'Unused',
            1 => 'Redeemed',
        ];

        return $statusLabels[$value] ?? 'Invalid';
    }
}
