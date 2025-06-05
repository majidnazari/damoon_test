<?php

namespace Database\Factories;
use App\Models\Booking;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TravelPackage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'package_id' => TravelPackage::factory(),
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->safeEmail,
            'travel_date' => $this->faker->date(),
        ];
    }
}
