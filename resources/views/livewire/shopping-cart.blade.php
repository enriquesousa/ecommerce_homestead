<div class="container py-8">

    {{-- tarjeta principal de presentación de productos --}}
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        
        <h1 class="text-lg font-semibold mb-6">CARRO DE COMPRAS</h1>

        @if (Cart::count())
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- @php
                        $cartCollection = \Cart::getContent()->sortBy('name');
                    @endphp --}}

                    @foreach (Cart::content() as $item)
                        <tr>
                            {{-- imagen y nombre --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        {{-- le quite rounded-full --}}
                                        <img class="h-15 w-20 object-cover object-center"
                                            src="{{ $item->options->image }}"
                                            alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$item->name}}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            @if ($item->options->color)
                                                <span>
                                                    Color: {{ __($item->options->color) }}
                                                </span>    
                                            @endif

                                            @if ($item->options->size)
                                                <span class="mx-1">-</span>
                                                <span>
                                                    {{ $item->options->size }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- precio y trash icon --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    <span>USD {{ $item->price }}</span>
                                    <a class="ml-6 cursor-pointer hover:text-red-600"
                                        wire:click="delete('{{$item->rowId}}')"
                                        wire:loading.class="text-red-600 opacity-25"
                                        wire:target="delete('{{$item->rowId}}')">
                                        <i class="fas fa-trash"></i>  
                                    </a>
                                </div>
                            </td>
                            
                            {{-- botones p/increment or decrement quantity --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    @if ($item->options->size)
                                        @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
                                    @elseif($item->options->color)
                                        @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                    @else
                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                    @endif
                                </div>
                            </td>
                            
                            {{-- Columna de Total --}}
                            <td class="text-center">
                                USD {{ $item->price * $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" wire:click="destroy">
                <i class="fas fa-trash"></i>
                Borrar carrito de compras
            </a>
        @else
            <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 mt-4">TU CARRO DE COMPRAS ESTA VACIÓ</p>

                <x-botoncolor href="/" class="mt-4 px-16">
                    Ir al inicio
                </x-botoncolor>
            </div>
        @endif

    </section>

    {{-- tarjeta que presenta el total de la orden y botón si desea continuar --}}
    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                {{-- total --}}
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total:</span>
                        USD {{ Cart::subTotal() }}
                    </p>
                </div>

                {{-- botón para continuar --}}
                <div>
                    <x-botoncolor href="{{ route('orders.create') }}" class="" color="orange">
                        Continuar
                    </x-botoncolor>
                </div>
            </div>
        </div>
    @endif

</div>
