<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->user()->id);
        
        if(request()->has('status')) {
            $orders = $orders->where('status', request('status'));
        }

        $orders = $orders->get();


        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $recibido = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $enviado = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $anulado = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();


        return view('orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado'));
    }

    public function show(Order $order){

        // proteger la vista con la policy de author ver app/Policies/OrderPolicy.php
        $this->authorize('author', $order);


        $items = json_decode($order->content); // Convertir el string en objeto json
        return view('orders.show', compact('order', 'items'));

    }

    // public function payment(Order $order){
    //     $items = json_decode($order->content); // Convertir el string en objeto json
    //     return view('orders.payment', compact('order', 'items'));
    // }

    // todo este método lo tenemos que copiar a webhooks __invoke() cuando ya estemos en producción
    public function pay(Order $order, Request $request){

        // regresar todo lo que nos estén enviando por la url
        // return $request->all();

        // proteger la vista con la policy de author ver app/Policies/OrderPolicy.php
        $this->authorize('author', $order);
        
        $payment_id = $request->get('payment_id'); // recuperar solo el payment_id
        // return $payment_id;

        // pedir el estatus de la orden a mercado pago
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-4651741262134650-051500-e2b1466eaa741346c683c5b8151da145-1124005997");
        // return $response;

        $response = json_decode($response);
        // dump($response);

        $status = $response->status;
        if ($status == 'approved') {
            $order->status = 2;
            $order->save();
        }
        
        return redirect()->route('orders.show', $order);
        // return $response;

    }
}
