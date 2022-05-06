<div class="container py-8">
    {{-- tarjeta principal de presentación de productos --}}
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        
        <h1 class="text-lg font-semibold mb-6">CARRO DE COMPRAS</h1>

        @if (! \Cart::isEmpty())
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

                    @php
                        $cartCollection = \Cart::getContent()->sortBy('name');
                    @endphp

                    @foreach ($cartCollection as $item)
                        <tr>
                            {{-- imagen y nombre --}}
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->attributes->image }}" alt="">
                                    <div>
                                        <p class="font-bold">{{ $item->name }}</p>
                                        @isset($item->attributes['color'])
                                            <span>
                                                Color: {{ __($item->attributes['color']) }}
                                            </span>
                                            {{-- <p class="mx-2">- Color: {{ __($item->attributes['color']) }}</p> --}}
                                        @endisset
                                        @isset($item->attributes['size'])
                                            <span class="mx-1">-</span>
                                            <span>
                                                {{ $item->attributes['size'] }}
                                            </span>
                                            {{-- <p>{{ $item->attributes['size'] }}</p> --}}
                                        @endisset
                                    </div>
                                </div>
                            </td>

                            {{-- precio y trash icon --}}
                            <td class="text-center">
                                <span>USD {{ $item->price }}</span>
                                <a class="ml-6 cursor-pointer hover:text-red-600" 
                                        wire:click="delete('{{ $item->id }}')"
                                        wire:loading.class="text-red-600 opacity-25"
                                        wire:target="delete('{{ $item->id }}')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            
                            {{-- botones p/increment or decrement quantity --}}
                            <td>    
                                <div class="flex justify-center">
                                    @if (isset($item->attributes['size']))
                                        @livewire('update-cart-item-size', ['rowId' => $item->id], key($item->id))    
                                    @elseif (isset($item->attributes['color']))
                                        @livewire('update-cart-item-color', ['rowId' => $item->id], key($item->id))
                                    @else
                                        @livewire('update-cart-item', ['rowId' => $item->id], key($item->id))    
                                    @endif
                                </div>
                            </td>
                            
                            {{-- Columna de Total --}}
                            <td class="text-center">
                                USD {{ $item->price * $item->quantity }}
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
    @if (! \Cart::isEmpty())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                {{-- total --}}
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total:</span>
                        USD {{ \Cart::getSubTotal() }}
                    </p>
                </div>

                {{-- botón para continuar --}}
                <div>
                    <x-botoncolor href="#" class="">
                        Continuar
                    </x-botoncolor>
                </div>
            </div>
        </div>
    @endif
</div>
