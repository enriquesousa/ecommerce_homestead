<?php 

use App\Models\Product;
use App\Models\Size;

// Calculamos el stock que tenemos de producto
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

// Con esto calculamos la cantidad de items agregados
function qty_added($product_id, $color_id = null, $size_id = null){

    // recuperar la colección del contenido del carrito
    $cart = \Cart::getContent();

    $item = $cart->where('id', $product_id)
                ->where('attributes.color_id', $color_id)   
                ->where('attributes.size_id', $size_id)->first();

    // Si existe un $item en el carrito de compras
    if ($item) {
        return $item->quantity;
    }else{
        return 0;
    }
}

// Calcular ahora la cantidad de items que aun podemos agregar a nuestro carrito de compras.
function qty_available($product_id, $color_id = null, $size_id = null){

    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);

}




