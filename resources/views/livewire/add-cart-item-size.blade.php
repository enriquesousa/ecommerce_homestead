<div x-data>

    {{-- Despliega Talla --}}
    <div>
        <p class="text-xl text-gray-700">Talla:</p>

        <select wire:model="size_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione una talla</option>

            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Despliega Color --}}
    <div class="mt-2">
        <p class="text-xl text-gray-700">Color:</p>

        <select wire:model="color_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione un color</option>

            @foreach ($colors as $color)
                <option class="capitalize" value="{{ $color->id }}">{{ __($color->name) }}</option>
            @endforeach
        </select>
    </div>

    <p class="text-gray-700 my-4">
        <span class="font-semibold text-lg">Stock disponible: </span>
        {{-- $quantity va a tener un valor cuando el user le asigne un color y talla --}}
        @if ($quantity)
            {{ $quantity }}
        @else
            {{-- stock total con todos los productos que tienen color y talla --}}
            {{ $product->stock }}
        @endif
    </p>

    {{-- cantidad y botón para agregar al carrito, incluir x-data en div padre para poder utilizar funcionalidades de alpine --}}
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

            {{-- botón customizado --}}
            <x-button   x-bind:disabled="!$wire.quantity" 
                        color="orange" 
                        class="w-full"
                        wire:click="addItem"
                        wire:loading.attr="disabled"
                        wire:target="addItem">

                Agregar a carrito de compras

            </x-button>

        </div>
    </div>

</div>
