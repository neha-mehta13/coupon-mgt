<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Coupon::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'code' => $faker->regexify('[A-Za-z0-9]{15}'),
            'brand_id' => $faker->numberBetween(1, 50),
            'status' => $faker->randomElement([0,1]),
            'redeemed_at' => NULL,
        ];

    }
}
