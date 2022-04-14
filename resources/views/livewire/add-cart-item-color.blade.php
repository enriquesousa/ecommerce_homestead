<div x-data>

    <p class="text-xl text-gray-700">Color:</p>

    {{-- aplicar clase a select, una clase que nosotros hicimos basada en resources/views/vendor/jetstream/components/input.blade.php, en resources/css/form.css le llamamos form-control --}}
    <select wire:model="color_id" class="form-control w-full">
        <option value="" selected disabled>Seleccionar un color</option>
        @foreach ($colors as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
        @endforeach
    </select>

    {{-- cantidad y botón para agregar al carrito, incluir x-data en div padre para poder utilizar funcionalidades de alpine --}}
    <div class="flex items-center mt-4">
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
            {{-- <x-botoncolor x-bind:disabled="!$wire.quantity" color="orange" class="w-full">
                Agregar a carrito de compras
            </x-botoncolor> --}}

            {{-- botón customizado --}}
            <x-button x-bind:disabled="!$wire.quantity" color="orange" class="w-full">
                Agregar a carrito de compras
            </x-button>

            {{-- boton de jetstream --}}
            {{-- <x-jet-button class="w-full">
                Agregar a carrito de compras
            </x-jet-button> --}}

        </div>
    </div>

</div>
