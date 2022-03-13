<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // la propiedad $guarded hace el efecto contrario a $fillable
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // relación uno a muchos
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    // relación uno a muchos inversa
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    // relación uno a muchos inversa
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    // relación muchos a muchos products con colors
    public function colors(){
        return $this->belongsToMany(Color::class);
    }

    // relación uno a muchos polimórfica
    public function images(){
        return $this->morphMany(Image::class, "imageable");
    }

}
