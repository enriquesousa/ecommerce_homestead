<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = Product::whereHas('subcategory', function(Builder $query){
            $query->where('color', true)->where('size', true);
        })->get();

        $sizes = ['Talla S', 'Talla M', 'Talla L'];

        foreach ($products as $product) {

            // a cada product de la colección le asignamos las 3 tallas
            foreach ($sizes as $size) {
                $product->sizes()->create([
                    'name' => $size
                ]);
            }
            
        }

        
    }
}
