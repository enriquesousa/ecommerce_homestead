<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use App\Models\Color;
use App\Models\Size;

class UpdateCartItemSize extends Component
{
    public $rowId, $qty, $quantity;
    
    public function mount(){
        $item = Cart::get($this->rowId);
        $this->qty = $item->quantity;

        $color = Color::where('name', $item->attributes['color'])->first();
        $size = Size::where('name', $item->attributes['size'])->first();
 
        $this->quantity = qty_available($item->id, $color->id, $size->id);
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
        Cart::update($this->rowId, array(
            'quantity' => -1,
            ));
        $this->emit('render');
    }

    public function increment(){
        $this->qty = $this->qty + 1;
        Cart::update($this->rowId, array(
            'quantity' => 1,
            ));
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.update-cart-item-size');
    }
}
