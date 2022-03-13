<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id'];

    // relación uno a muchos inversa
    public function product(){
        return $this->belongsTo(Product::class);
    }

    // relación muchos a muchos sizes con colors
    public function colors(){
        return $this->belongsToMany(Color::class);
    }

}
