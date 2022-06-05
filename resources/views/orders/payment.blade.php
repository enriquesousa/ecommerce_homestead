<x-app-layout>

    {{-- payment.blade.php para mercado PayPal --}}


    <div class="grid grid-cols-5 gap-6 container py-8">

        <div class="col-span-3">
    
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
    
        </div>

        <div class="col-span-2">

            <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
                {{-- Tarjeta 4 - Imagen Visa Master Card y botón de Pagar! --}}
                <div class="flex justify-between items-center">
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

        </div>

    </div>
    

</x-app-layout>