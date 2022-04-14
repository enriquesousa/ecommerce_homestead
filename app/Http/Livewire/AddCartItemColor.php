<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItemColor extends Component
{

    public $product, $colors;
    public $color_id="";

    public $qty = 1;
    public $quantity = 0;

    public function mount(){
        // recuperar la relación de products con colors
        $this->colors = $this->product->colors;
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }

    // cada vez que se utilize como inicio de nombre de método el nombre updated
    // seguido de un nombre de variable "ColorId" que exista en esta clase, entonces este método
    // se ejecutara cada vez que esta variable cambie de valor!
    // recuperamos el valor de quantity pero de la tabla intermedia color_product
    public function updatedColorId($value){
        $this->quantity = $this->product->colors->find($value)->pivot->quantity;
    }

}
