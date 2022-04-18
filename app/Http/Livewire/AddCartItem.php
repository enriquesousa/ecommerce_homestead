<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class AddCartItem extends Component
{
    public $product; //para recibir la información que nos manda el componente @livewire('add-cart-item', ['product' => $product]) de resources/views/products/show.blade.php
    public $quantity;
    public $qty = 1;

    public function mount(){
        $this->quantity = $this->product->quantity;
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
                ]);
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}