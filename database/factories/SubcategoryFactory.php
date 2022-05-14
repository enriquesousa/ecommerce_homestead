<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // usar este paquete para generar images random. https://github.com/smknstd/fakerphp-picsum-images 
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));
        
        return [
            // 'image' => 'subcategories/' . $this->faker->image('public/storage/subcategories', 640, 480, null, false), // con false me regresa solo: imagen.jpg
            'image' => $this->faker->imageUrl(640, 480),
            // 'image' => $faker->imageUrl(640, 480), // usando el paquete
        ];
    }
}
