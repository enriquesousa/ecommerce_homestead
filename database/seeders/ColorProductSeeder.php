<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ColorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // consulta a las relaciones del modelo Product
        // nos regresara todos los productos solo si 
        // el color es true y size es false 
        $products = Product::whereHas('subcategory', function(Builder $query){
            $query->where('color', true)->where('size', false);
        })->get();

        // para introducir registros a la tabla intermedia color_product
        // cada uno de estos productos van a tener 4 colores, 10 de cada color
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 10
                ], 
                2 => [
                    'quantity' => 10
                ], 
                3 => [
                    'quantity' => 10
                ], 
                4 => [
                    'quantity' => 10
                ]
            ]);
        }        

    }
}
