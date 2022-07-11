<div x-data>

    <p class="text-xl text-gray-700">Color:</p>

    {{-- aplicar clase a select, una clase que nosotros hicimos basada en resources/views/vendor/jetstream/components/input.blade.php, en resources/css/form.css le llamamos form-control --}}
    <select wire:model="color_id" class="form-control w-full">
        <option value="" selected disabled>Seleccionar un color</option>
        @foreach ($colors as $color)
            <option value="{{ $color->id }}">{{ __($color->name) }}</option>
        @endforeach
    </select>

    {{-- $quantity va a tener un valor cuando el user le asigne un color --}}
    <p class="text-gray-700 my-4">
        <span class="font-semibold text-lg">Stock disponible:</span>
        @if ($quantity)
            {{-- Despliega solo la cantidad del color que se haya seleccionado  --}}
            {{$quantity}}
        @else
            @if ($outofstock == true)
                0
            @else
                {{-- Despliega el total de productos de todos los colores  --}}
                {{$product->stock}}
            @endif
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
