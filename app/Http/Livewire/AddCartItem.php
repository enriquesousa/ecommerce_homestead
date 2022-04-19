<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public $product; //para recibir la información que nos manda el componente @livewire('add-cart-item', ['product' => $product]) de resources/views/products/show.blade.php
    public $quantity;
    public $qty = 1;

    public $options = [
        'color_id' => null,
        'size_id' => null
    ];

    public function mount(){
        $this->quantity = $this->product->quantity;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){

        // dd($this->product);
        // dd($this->qty);

        Cart::add([ 'id' => $this->product->id, 
                    'name' => $this->product->name, 
                    'quantity' => $this->qty,
                    'price' => $this->product->price, 
                    'weight' => 550,
                    'attributes' => $this->options,
                ]);

        // para poder tener actualizado el numero de quantity del carrito de compras, vamos a emitir un evento
        // lo tiene que recibir el componente DropdownCart.php y su vista
        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
