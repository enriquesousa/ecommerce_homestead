<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    use HasFactory;

    // tabla que queremos que administre
    protected $table = "color_size";

    // relación uno a muchos inversa con colors
    public function color(){
        return $this->belongsTo(Color::class);
    }
    // relación uno a muchos inversa con sizes
    public function size(){
        return $this->belongsTo(Size::class);
    }

}
