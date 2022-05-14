<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{

    public $product, $colors;
    public $color_id="";

    public $qty = 1;
    public $quantity = 0;

    public $options = [
        'size_id' => null
    ];

    public $outofstock = false;

    public function mount(){
        // recuperar la relación de products con colors
        $this->colors = $this->product->colors;
        // $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['image'] = $this->product->images->first()->url;
    }

    /**
     * Ciclo de vida 
     * cada vez que se utilize como inicio de nombre de método el nombre updated
     * seguido de un nombre de variable "ColorId" que exista en esta clase, entonces este método
     * se ejecutara cada vez que esta variable cambie de valor!
     * recuperamos el valor de quantity pero de la tabla intermedia color_product
     */
    public function updatedColorId($value){
        $color = $this->product->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id);
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
        $this->quantity = qty_available($this->product->id, $this->color_id);
        if ($this->quantity == 0) {
            $this->outofstock = true;
        }

        // reset la propiedad de qty para los botones + y -
        $this->reset('qty');

        // para poder tener actualizado el numero de quantity del carrito de compras, vamos a emitir un evento
        // lo tiene que recibir el componente DropdownCart.php y su vista
        $this->emitTo('dropdown-cart', 'render');
    }


    /* 
     * El método render() siempre va al final 
     */
    public function render()
    {
        return view('livewire.add-cart-item-color');
    }

}