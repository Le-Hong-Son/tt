<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'category_id' => Category::all()->random()->id,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->sentence, // 
            'stock' => $this->faker->numberBetween(0, 100),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
            'image' => $this->faker->imageUrl,
            
        ];
    }
}
