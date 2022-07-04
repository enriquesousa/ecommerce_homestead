<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // relación muchos a muchos colors con products
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    // relación muchos a muchos colors con sizes
    public function sizes(){
        return $this->belongsToMany(Size::class);
    }

}
