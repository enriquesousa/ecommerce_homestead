<div>
    
    <x-jet-dropdown width="96">
        
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">

                <x-cart color="white" size="30" />

                {{-- carrito badge indica 99 --}}
                {{-- <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">99</span> --}}

                {{-- solo el puntito rojo (carrito vacío) --}}
                <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span></span>

            </span>
        </x-slot>
        
        <x-slot name="content">

            <ul>

                @forelse (\Cart::getContent() as $item)
                    <li class="flex">
                        {{-- primer imagen del producto --}}
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->attributes->image }}" alt="">

                        {{-- Nombre y Precio del producto --}}
                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>
                            <p>Cant: {{ $item->quantity }}</p>
                            <p>USD {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    {{-- Si la colección esta vaciá --}}
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningún item en el carrito 
                        </p>
                    </li>
                @endforelse

            </ul>
            
        </x-slot>

    </x-jet-dropdown>

</div>
