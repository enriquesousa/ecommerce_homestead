<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    // la propiedad $guarded hace el efecto contrario a $fillable
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // relación uno a muchos
    public function products(){
        return $this->hasMany(Product::class);
    }

    // relación uno a muchos inversa, le llamamos en singular porque al llamarla solo tendrá una sola categoría
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
