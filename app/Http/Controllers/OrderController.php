<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function show(Order $order){
        return view('orders.show', compact('order'));
    }

    public function payment(Order $order){
        $items = json_decode($order->content); // Convertir el string en objeto json
        return view('orders.payment', compact('order', 'items'));
    }
}
