<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;


class WelcomeController extends Controller
{
    public function __invoke()
    {

        // chechar primero si el usuario esta logueado
        if (auth()->user()) {
            // session()->flash('flash.banner', 'Eso es un mensaje de flash');
            // session()->flash('flash.bannerStyle', 'danger'); // cambiar el color del banner a rojo

            $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();

            if ($pendiente) {

                $mensaje = 'Tienes ' . $pendiente . ' pedido(s) pendiente(s)' . " ir a <a class='font-bold' href='" . route('orders.index') ."?status=1'>Pedidos</a> para verlos";

                session()->flash('flash.banner', $mensaje);
            }
        }

        $categories = Category::all();

        return view('welcome', compact('categories'));
    }
}
