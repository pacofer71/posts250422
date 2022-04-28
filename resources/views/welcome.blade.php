<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>



    <!-- Styles -->
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


</head>

<body class="antialiased">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($posts as $item)
                    <article
                        class="w-full h-80 bg-cover bg-center @if ($loop->first) lg:col-span-2 @endif"
                        style="background-image:url({{ Storage::url($item->img) }}) ">
                        <div class="flex flex-col justify-center w-full h-full">
                            <div>
                                <h1 class="px-2 text-xl text-gray-400 font-bold">{{ $item->titulo }}</h1>
                            </div>
                            <div class="mt-2 px-2 font-bold text-gray-200 items-center">
                                ({{ $item->user->email }})
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-2">
                {{ $posts->links() }}
            </div>
        </div>
    </div>


</body>

</html>
