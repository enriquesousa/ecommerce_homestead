<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
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
            // 'url' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false), // con false me regresa solo: imagen.jpg
            // 'url' => 'products/' . $this->faker->image(null, 640, 480, null, false)
            'url' => $this->faker->imageUrl(640, 480),
            // 'url' => $faker->imageUrl(640, 480), // usando el paquete
        ];
    }
}
