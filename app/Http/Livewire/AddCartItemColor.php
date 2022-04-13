<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItemColor extends Component
{

    public $product, $colors;

    public function mount(){
        // recuperar la relación de products con colors
        $this->colors = $this->product->colors;
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }
}
