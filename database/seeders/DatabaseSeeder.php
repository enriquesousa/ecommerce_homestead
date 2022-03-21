<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/products'); // borrar la carpeta por si ya existía
        Storage::makeDirectory('public/products'); // crear la carpeta /storage/app/public/products
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
