<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

class AddCartItemSize extends Component
{

    public $product, $sizes;
    public $color_id="";
    public $qty = 1;
    public $quantity = 0;
    public $size_id = "";
    public $colors = [];

    // mantente a la escucha de la propiedad $size_id
    public function updatedSizeId($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
    }

    // mantente a la escucha de la propiedad $color_id
    public function updatedColorId($value){
        $size = Size::find($this->size_id);
        $this->quantity = $size->colors->find($value)->pivot->quantity;
    }

    public function mount(){
        $this->sizes = $this->product->sizes;
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
