<x-app-layout>

    {{-- payment.blade.php para mercado pago --}}

    @php
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        $shipments = new MercadoPago\Shipments();
        $shipments->cost = $order->shipping_cost;
        $shipments->mode = "not_specified";

        // agregar $shipments a nuestro objeto $preference
        $preference->shipments = $shipments;

        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;

            $products[] = $item;
        }

        // Redije al usuario cuando ya realizo el pago
        $preference->back_urls = array(
            "success" => route('orders.pay', $order),
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";

        $preference->items = $products;
        $preference->save();

    @endphp

    <div class="container py-4">

        {{-- Tarjeta 1 - Numero de Orden --}}
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700 uppercase"><span class="font-semibold">Número de order:</span> Orden-{{ $order->id }}</p>
        </div>

        {{-- Tarjeta 2 - Dirección de envió y Datos del Contacto --}}
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            {{-- grid de 2 columnas--}}
            <div class="grid grid-cols-2 gap-6 text-gray-700">

                {{-- 1er columna, Datos Dirección donde se va a enviar producto --}}
                <div>
                    <p class="text-lg font-semibold uppercase">Envío</p>

                    @if ($order->envio_type == 1)
                        <p class="text-sm">Los productos deben de ser recogidos en tienda</p>
                        <p class="text-sm">Calle falsa 123</p>
                    @else
                        <p class="text-sm">Los productos serán enviados a:</p>
                        <p class="text-sm">{{ $order->address }}</p>
                        <p>{{ $order->city->name }} - {{ $order->department->name }} - {{ $order->district->name }}</p>
                    @endif
                </div>

                {{-- 2da columna, Datos del Contacto --}}
                <div>
                    <p class="text-lg font-semibold uppercase">Datos del Contacto</p>

                    <p class="text-sm">Persona que recibirá el producto: {{ $order->contact }}</p>
                    <p class="text-sm">Teléfono de contacto: {{ $order->phone }}</p>
                </div>
            </div>
        </div>

        {{-- Tarjeta 3 - Resumen de la orden --}}
        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-4">Resumen</p>

            {{-- Tabla --}}
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200"> 

                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    {{-- altura fija de 15,ancho fijo de 20, no se deforme imagen, margin right 4 --}}
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                    <article>
                                        <h1 class="font-bold">{{ $item->name }}</h1>
                                        <div class="flex text-xs">
                                            @isset ($item->options->color)
                                                Color: {{ __($item->options->color) }}
                                            @endisset
                                            @isset ($item->options->size)
                                                - {{ $item->options->size }}
                                            @endisset
                                        </div>
                                    </article>
                                </div>
                            </td>

                            <td class="text-center">
                                {{ $item->price }} USD
                            </td>

                            <td class="text-center">
                                {{ $item->qty }}
                            </td>

                            <td class="text-center">
                                {{ $item->price * $item->qty }} USD
                            </td> 

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tarjeta 4 - Imagen Visa Master Card y botón de Pagar! --}}
        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 flex justify-between items-center">
            {{-- lo que hace asset() es colocarnos en la carpeta pubic --}}
            <img class="h-8" src="{{ asset('img/MC_VI_DI_2-1.jpg') }}" alt="">
            <div class="text-gray-700" style="text-align: right">
                {{-- Subtotal --}}
                <p class="text-sm font-semibold">
                    Subtotal: {{ $order->total - $order->shipping_cost }} USD
                </p>
                {{-- Envío --}}
                <p class="text-sm font-semibold">
                    Envío: {{ $order->shipping_cost }} USD
                </p>
                {{-- Total --}}
                <p class="text-lg font-semibold uppercase">
                    Pago: {{ $order->total }} USD
                </p>
                {{-- botón de mercado pago  --}}
                <div class="cho-container">

                </div>

            </div>
        </div>

    </div>

    {{-- Add the MercadoPago SDK.js/v2 --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    {{-- Script para botón PAGAR de Marcado Pago --}}
    <script>
        // Agregar credenciales SDK
        const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
            locale: 'pt-BR'
        });

        // Inicializa el checkout
        const checkout = mp.checkout({
        preference: {
            id: '{{ $preference->id }}' // Enter the preference ID
        },
        render: {
            container: '.cho-container', // CSS class to render the payment button
            label: 'Pagar', // Change payment button text (optional)
            }
        });
    </script>       

</x-app-layout>