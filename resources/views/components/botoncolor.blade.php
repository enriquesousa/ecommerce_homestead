{{-- para poderle enviar información a este componente --}}
@props(['color' => 'gray'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "bg-$color-500 hover:bg-$color-700 text-white font-bold py-2 px-4 rounded"]) }}>
    {{ $slot }}
</button>