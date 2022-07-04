<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

// para poder utilizar la protección de las políticas de autorización en un componente de livewire
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class PaymentOrder extends Component
{
    use AuthorizesRequests;

    public $order;

    protected $listeners = ['payOrder'];

    public function mount(Order $order){
        $this->order = $order;

    }

    public function payOrder(){
        $this->order->status = 2;
        $this->order->save();

        return redirect()->route('orders.show', $this->order);
    }

    public function render()
    {   
        // proteger la vista con la policy de author ver app/Policies/OrderPolicy.php
        $this->authorize('author', $this->order);
        // si ya pagaste la orden no permitir volver a pagar
        $this->authorize('payment', $this->order);

        $items = json_decode($this->order->content);
        return view('livewire.payment-order', compact('items'));
    }
}
