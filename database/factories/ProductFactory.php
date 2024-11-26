<?php

namespace Database\Factories;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $name=$this->faker->word(3);
        return [
            'name'=>$name,
             // Generate a slug based on the name
             'slug' => Str::slug($name),

             // Generate a fake image URL (you can adjust this as needed)
             'image' => $this->faker->imageUrl(640, 480, 'products'),
 
             // Assign the first category's ID, or null if no category exists
             'category_id' => CategoryRepository::getRandemId(),
             'store_id'=> StoreRepository::getRandemId()
        ];
    }
}
