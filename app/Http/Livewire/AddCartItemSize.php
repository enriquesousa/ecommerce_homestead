<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemSize extends Component
{

    public $product, $sizes;
    public $color_id="";
    public $qty = 1;
    public $quantity = 0;
    public $size_id = "";
    public $colors = [];
    public $options = [];

    public $outofstock = false;

    public function mount(){
        $this->sizes = $this->product->sizes;
        // $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['image'] = $this->product->images->first()->url;
    }

    // mantente a la escucha de la propiedad $size_id
    public function updatedSizeId($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
    }

    // mantente a la escucha de la propiedad $color_id
    public function updatedColorId($value){
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){
        Cart::add([ 'id' => $this->product->id, 
                    'name' => $this->product->name, 
                    'qty' => $this->qty,
                    'price' => $this->product->price, 
                    'options' => $this->options,
                ]);

        // para actualizar la propiedad de quantity
        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);
        if ($this->quantity == 0) {
            $this->outofstock = true;
        }

        // reset la propiedad de qty
        $this->reset('qty');
        
        // para poder tener actualizado el numero de quantity del carrito de compras, vamos a emitir un evento
        // lo tiene que recibir el componente DropdownCart.php y su vista
        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
