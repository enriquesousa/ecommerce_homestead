<?php 

use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

// Calculamos el stock que tenemos de producto en la base de datos
function quantity($product_id, $color_id = null, $size_id = null){

    $product = Product::find($product_id);

    if ($size_id) {
        $size = Size::find($size_id);
        $quantity = $size->colors->find($color_id)->pivot->quantity;
    }elseif($color_id){
        $quantity = $product->colors->find($color_id)->pivot->quantity;
    }else{
        $quantity = $product->quantity;
    }

    return $quantity;
}

// Con esto calculamos la cantidad de items agregados al carrito de compras
function qty_added($product_id, $color_id = null, $size_id = null){

    // recuperar la colección del contenido del carrito
    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
                ->where('options.color_id', $color_id)   
                ->where('options.size_id', $size_id)
                ->first();

    // Si existe un $item en el carrito de compras
    if ($item) {
        return $item->qty;
    }else{
        return 0;
    }
}

// La resta de ambos
// Calcular ahora la cantidad de items que aun podemos agregar a nuestro carrito de compras.
function qty_available($product_id, $color_id = null, $size_id = null){

    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);

}

// función para descontar el stock del producto en la base de datos
function discount($item){
    $product = Product::find($item->id);
    $qty_available = qty_available($item->id, $item->options->color_id, $item->options->size_id);
   
    if ($item->options->size_id) {

        $size = Size::find($item->options->size_id);
        // eliminar registro de la tabla intermedia
        $size->colors()->detach($item->options->color_id);
        // Volver a crearlo
        $size->colors()->attach([
            $item->options->color_id => ['quantity' => $qty_available]
        ]);

    }elseif($item->options->color_id){

        // eliminar registro de la tabla intermedia
        $product->colors()->detach($item->options->color_id);
        // Volver a crearlo
        $product->colors()->attach([
            $item->options->color_id => ['quantity' => $qty_available]
        ]);

    }else{

        $product->quantity = $qty_available;
        $product->save();
    } 
}

// función para incrementar el stock en la base de datos, para anular pedido que no se completo su pago
function increase($item){
    $product = Product::find($item->id);
    $quantity = quantity($item->id, $item->options->color_id, $item->options->size_id) + $item->qty;
   
    if ($item->options->size_id) {

        $size = Size::find($item->options->size_id);
        // eliminar registro de la tabla intermedia
        $size->colors()->detach($item->options->color_id);
        // Volver a crearlo
        $size->colors()->attach([
            $item->options->color_id => ['quantity' => $quantity]
        ]);

    }elseif($item->options->color_id){

        // eliminar registro de la tabla intermedia
        $product->colors()->detach($item->options->color_id);
        // Volver a crearlo
        $product->colors()->attach([
            $item->options->color_id => ['quantity' => $quantity]
        ]);

    }else{

        $product->quantity = $quantity;
        $product->save();
    } 
}



