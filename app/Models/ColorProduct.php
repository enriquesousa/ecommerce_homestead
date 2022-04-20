<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    // tabla que queremos que administre
    protected $table = "color_product";

    // relación uno a muchos inversa con colors
    public function color(){
        return $this->belongsTo(Color::class);
    }
    // relación uno a muchos inversa con products
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
