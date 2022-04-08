<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Component
{
    use WithPagination;
    
    public $category, $subcategoria, $marca;

    public $view = "grid";

    // reset propiedades $subcategoria, $marca.
    public function limpiar(){
        $this->reset(['subcategoria', 'marca']);
    }

    public function render()
    {
        // $products = $this->category->products()->where('status', 2)->paginate(20);

        // para poder relacionarnos con la categoría tenemos que pasar primero por subcategory
        // al agregarle la función query() lo hacemos consulta y no colección.
        $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
            $query->where('id', $this->category->id);
        });

        // aquí generamos una consulta para cuando seleccionan una Subcategoría
        if ($this->subcategoria) {
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('name', $this->subcategoria);
            });
        }

        // aquí generamos una consulta para cuando seleccionan una marca
        if ($this->marca) {
            $productsQuery = $productsQuery->whereHas('brand', function(Builder $query){
                $query->where('name', $this->marca);
            });
        }

        // aquí ya vamos a crear la colección.
        $products = $productsQuery->paginate(20);

        return view('livewire.category-filter', compact('products'));
    }
}
