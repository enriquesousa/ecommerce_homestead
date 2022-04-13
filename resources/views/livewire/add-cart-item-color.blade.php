<div>

    <p class="text-xl text-gray-700">Color:</p>

    {{-- aplicar clase a select, una clase que nosotros hicimos basada en resources/views/vendor/jetstream/components/input.blade.php, en resources/css/form.css le llamamos form-control --}}
    <select class="form-control w-full">
        <option value="" selected disabled>Seleccionar un color</option>
        @foreach ($colors as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
        @endforeach
    </select>

</div>
