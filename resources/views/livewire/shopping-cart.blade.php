<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        
        <h1 class="text-lg font-semibold mb-6">CARRO DE COMPRAS</h1>

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
                @foreach (\Cart::getContent() as $item)
                    <tr>
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

                        <td>
                            <span>USD {{ $item->price }}</span>
                            <a class="ml-6 cursor-pointer hover:text-red-600">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        
                        <td>    

                            @if (isset($item->attributes['size']))
                                @livewire('update-cart-item-size', ['rowId' => $item->id], key($item->id))    
                            @elseif (isset($item->attributes['color']))
                                @livewire('update-cart-item-color', ['rowId' => $item->id], key($item->id))
                            @else
                                @livewire('update-cart-item', ['rowId' => $item->id], key($item->id))    
                            @endif

                        </td>
                        
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </section>
</div>
