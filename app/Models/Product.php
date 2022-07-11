<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    // la propiedad $guarded hace el efecto contrario a $fillable
    // que campos no quiero que asigne a la asignaciones masiva
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // accesores
    public function getStockAttribute(){

        if ($this->subcategory->size) {
            // producto que necesita talla y color
            // whereHas se utiliza para buscar en la relación
            // Primero verifica la relación con size y luego la relación con product
            return ColorSize::whereHas('size.product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');

        }elseif($this->subcategory->color) {
            // producto que solo necesita color
            return ColorProduct::whereHas('product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');

        }else{
            // producto que solo necesita cantidad
            return $this->quantity;
        }
        
    }

    public function getTestAttribute(){
        return "Probando accessor";
    }

    // relación uno a muchos products y sizes
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
        return $this->belongsToMany(Color::class)->withPivot('quantity');
    }

    // relación uno a muchos polimórfica
    public function images(){
        return $this->morphMany(Image::class, "imageable");
    }

    // url amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
