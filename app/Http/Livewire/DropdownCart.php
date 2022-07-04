<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DropdownCart extends Component
{
    // si escuchas el evento render, manda llamar a render()
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.dropdown-cart');
    }
}
