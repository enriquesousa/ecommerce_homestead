<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;
use App\Http\Controllers\WebhooksController;
use App\Http\Livewire\PaymentOrder;

use App\Models\Order;
use Illuminate\Support\Carbon;

Route::get('/', WelcomeController::class);
Route::get('search', SearchController::class)->name('search');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');

// Grupo de rutas con el mismo middleware
Route::middleware(['auth'])->group(function(){

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/create', CreateOrder::class)->name('orders.create');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');
    // Por lo mientras que estamos en desarrollo utilizaremos esta ruta
    Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::post('webhooks', WebhooksController::class);

});

Route::get('prueba', function(){
    // que hora era hace 10 minutos, usar carbon
    $hora = now()->subMinutes(10);
    // echo $hora->toDateTimeString();
    // $current_date_time=Carbon::now();

    $orders = Order::where('status', 1)->whereTime('created_at', '<=', $hora)->get();

    foreach ($orders as $order) {
        $items = json_decode($order->content);
        foreach ($items as $item) {
            increase($item); // llamar al helper
        }
        $order->status = 5; // anulado
        $order->save();
    }

    return "Se anulo el pedido";

});



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
