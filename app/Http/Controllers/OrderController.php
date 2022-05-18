<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function show(Order $order){
        return view('orders.show', compact('order'));
    }

    public function payment(Order $order){
        $items = json_decode($order->content); // Convertir el string en objeto json
        return view('orders.payment', compact('order', 'items'));
    }

    // todo este método lo tenemos que copiar a webhooks __invoke() cuando ya estemos en producción
    public function pay(Order $order, Request $request){

        // regresar todo lo que nos estén enviando por la url
        // return $request->all();

        $payment_id = $request->get('payment_id'); // recuperar solo el payment_id

        // pedir el estatus de la orden a mercado pago
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-4651741262134650-051500-e2b1466eaa741346c683c5b8151da145-1124005997");

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
