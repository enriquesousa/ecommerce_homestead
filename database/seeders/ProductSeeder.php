<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // por cada producto que creamos quiero 4 imágenes, default 250 productos con 4 imágenes cada uno
        Product::factory(250)->create()->each(function (Product $product){
            Image::factory(4)->create([
                'imageable_id' => $product->id,
                'imageable_type' => Product::class,
            ]);
        });


    }
}
