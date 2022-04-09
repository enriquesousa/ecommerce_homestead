<div x-data>

    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-lg">Stock disponible: </span>
        {{ $quantity }}
    </p>

    {{-- cantidad y botón para agregar al carrito --}}
    <div class="flex items-center">
        {{-- cantidad para agregar al carrito --}}
        <div class="mr-4">
            <x-jet-secondary-button 
                disabled 
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement">
                -
            </x-jet-secondary-button>

            <span class="mx-2 text-gray-700">{{ $qty }}</span>

            <x-jet-secondary-button 
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>

        {{-- botón para agregar al carrito --}}
        <div class="flex-1">

            {{-- botón de tailwind --}}
            {{-- <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded w-full">
                Agregar a carrito de compras
            </button> --}}

            {{-- botón de tailwind con porps para pasar parámetros--}}
            <x-botoncolor color="orange" class="w-full">
                Agregar a carrito de compras
            </x-botoncolor>

            {{-- botón customizado --}}
            {{-- <x-button color="orange" class="w-full">
                Agregar a carrito de compras
            </x-button> --}}

            {{-- boton de jetstream --}}
            {{-- <x-jet-button class="w-full">
                Agregar a carrito de compras
            </x-jet-button> --}}

        </div>
    </div>

</div>
