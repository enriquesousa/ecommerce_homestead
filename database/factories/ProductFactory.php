<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Str;

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
    public function definition()
    {

        $name = $this->faker->sentence(2);

        // recuperar una subcategory al azar
        $subcategory = Subcategory::all()->random();
        // recuperar la categoría a la que pertenece esta subcategory
        $category = $subcategory->category;
        // recuperar la colección de marcas de esta categoría y escoger una al azar
        $brand = $category->brands->random();

        // En caso que color sea true en $subcategory NO almacenar quantity dejarla en NULL
        if ($subcategory->color) {
            $quantity = null;
        }else{
            $quantity = 15;
        }

        if ($subcategory->color) {
            $name = "Con Color";
        }

        if ($subcategory->size) {
            $name = "Con Color y Size";
        }

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19.99, 49.99, 99.99]),
            'subcategory_id' => $subcategory->id,
            'brand_id' => $brand->id,
            'quantity' => $quantity,
            'status' => 2
        ];
    }
}
