<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class ShoppingCart extends Component
{
    // si escuchas el evento render, manda llamar a render()
    protected $listeners = ['render'];
    
    // Eliminar todos productos en carrito de compras
    public function destroy()
    {
        Cart::clear();

        // para que limpie también el DropdownCart 
        $this->emitTo('dropdown-cart', 'render');
    }

    // Eliminar solo un producto del carrito de compras
    public function delete($rowId)
    {
        Cart::remove($rowId);

        // para que limpie también producto en DropdownCart 
        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
