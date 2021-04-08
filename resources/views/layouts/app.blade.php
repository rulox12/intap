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

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">

    <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div x-data="{ show: true }" x-show="show" class="bg-red-50 p-4 rounded flex items-start text-red-600 my-4 shadow-lg max-w-xl mx-auto">
                        <div class="text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z"/></svg>
                        </div>
                        <div class=" px-3">
                            <h3 class="text-red-800 font-semibold tracking-wider">
                                {{__('Error')}}
                            </h3>
                            <p class="py-2 text-red-700">
                                {{$error}}
                            </p>
                        </div>
                        <button type="button" @click="show = false"  class=" text-red-100">
                            <span class="text-2xl text-red-800">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-green-50 p-4 rounded flex items-start text-green-600 my-4 shadow-lg max-w-xl mx-auto">
                    <div class="text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z"/></svg>
                    </div>
                    <div class=" px-3">
                        <h3 class="text-green-800 font-semibold tracking-wider">
                            {{__('Success')}}
                        </h3>
                        <p class="py-2 text-green-700">
                            {{session('success')}}
                        </p>
                    </div>
                    <button type="button" @click="show = false"  class=" text-green-100">
                        <span class="text-2xl text-red-800">&times;</span>
                    </button>
                </div>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
