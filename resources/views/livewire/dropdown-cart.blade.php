<div>
    
    <x-jet-dropdown width="96">
        
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">

                <x-cart color="white" size="30" />

                {{-- Me da el total de productos distintos - \Cart::getContent()->count()
                Me da el total de quantity de productos en el carrito - \Cart::getTotalQuantity() --}}

                @if (\Cart::getContent()->count())
                    {{-- carrito badge indica 99 --}}
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ \Cart::getTotalQuantity() }}</span>
                @else
                    {{-- solo el puntito rojo (carrito vacío) --}}
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span></span>    
                @endif

            </span>
        </x-slot>
        
        <x-slot name="content">

            {{-- desplegar los productos --}}
            <ul>
                @forelse (\Cart::getContent() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        {{-- primer imagen del producto --}}
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->attributes->image }}" alt="">

                        {{-- Nombre y Precio del producto --}}
                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>
                            <div class="flex">
                                <p>Cant: {{ $item->quantity }}</p>
                                {{-- isset se usa para saber si el parámetro esta definido --}}
                                @isset($item->attributes['color'])
                                    <p class="mx-2">- Color: {{ __($item->attributes['color']) }}</p>
                                @endisset
                                @isset($item->attributes['size'])
                                    <p>{{ $item->attributes['size'] }}</p>
                                @endisset
                            </div> 
                            <p>USD {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    {{-- Si la colección esta vacía --}}
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningún item en el carrito 
                        </p>
                    </li>
                @endforelse
            </ul>

            {{-- count carts contents - $cartCollection->count(); --}}
            @if (\Cart::getContent()->count())
                <div class="py-2 px-3">
                    <p class="text-lg text-gray-700 mt-2 mb-3"><span class="font-bold">Total:</span> USD$ {{ \Cart::getTotal() }}</p>
                    
                    {{-- <x-button-enlace  href="{{ route('shopping-cart') }}" color2="yellow" class="w-full">
                        Ir al carrito de compras 3
                    </x-button-enlace> --}}

                    {{-- botón customizado --}}
                    {{-- <x-button href="{{ route('shopping-cart') }}" color="orange" class="w-full">
                        Ir al carrito de compras
                    </x-button> --}}
                    
                    {{-- botón x-jet --}}
                    {{-- <a href="shopping-cart">
                        <x-jet-button class="w-full"> 
                            Ir al carrito de compras
                        </x-jet-button>
                    </a> --}}

                    {{-- botón de tailwind --}}
                    {{-- <a href="{{ route('shopping-cart') }}" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded w-full">
                        Ir al carrito de compras
                    </a> --}}

                    <x-button-enlace href="{{ route('shopping-cart') }}" color="orange" class="w-full">
                        Ir al carrito de compras
                    </x-button-enlace>
                </div>
            @endif
            
        </x-slot>

    </x-jet-dropdown>

</div>
