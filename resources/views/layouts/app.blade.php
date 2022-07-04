<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        {{-- Fontawesome --}}
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        {{-- Glider --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- jquery cdn --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        {{-- FlexSlider --}}
        <link rel="stylesheet" href="{{ asset('vendor/FlexSlider/flexslider.css') }}">


        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        {{-- Glider --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js" integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- FlexSlider --}}
        <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>

    </head>

    <body class="font-sans antialiased">

        {{-- {{ \Debugbar::disable(); }} --}}

        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            function dropdown(){
                return {
        
                    open: false,
                    show(){
                        if(this.open){
                            // se cierra la ventana modal del menu
                            this.open = false;
                            document.getElementsByTagName('html')[0].style.overflow = 'auto'
                        }else{
                            // se abre la ventana modal del menu
                            this.open = true;
                            // deshabilitar el scroll
                            document.getElementsByTagName('html')[0].style.overflow = 'hidden'
                        }
                    },
                    close(){
                        // para que reaparecer el scroll si cerramos menu con click away
                        this.open = false;
                        document.getElementsByTagName('html')[0].style.overflow = 'auto'
                    }
                }
            }
        </script>
        
        @stack('script')

    </body>

</html>
