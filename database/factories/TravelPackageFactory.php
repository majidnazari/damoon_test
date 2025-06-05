<?php

namespace Database\Factories;
use App\Models\TravelPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelPackage>
 */
class TravelPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TravelPackage::class;

    public function definition()
    {
        return [
            'name' =>$this->faker->name,
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'location' => $this->faker->city,
        ];
    }
}
