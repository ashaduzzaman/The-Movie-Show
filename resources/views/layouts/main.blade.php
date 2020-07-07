<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie App</title>
    <link rel="stylesheet" href="/css/main.css">
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
</head>
<body class="font-sans bg-gray-900 text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto flex flex-col md:flex-row px-4 items-center justify-between px-4 py-6">
            <ul class="flex flex-col md:flex-row items-center">
                <li>
                    <a href="{{ route('movies.index')}}">
                        MovieApp
                    </a>
                </li>
                <li class="md:ml-16  mt-3 md:mt-0">
                    <a href="{{ route('movies.index')}}" class="hover:text-gray-300">Movies</a>
                </li>
                <li class="md:ml-6  mt-3 md:mt-0">
                    <a href="{{ route('tvshows.index')}}" class="hover:text-gray-300">TV Shows</a>
                </li>
                <li class="md:ml-6  mt-3 md:mt-0">
                    <a href="{{ route('peoples.index')}}" class="hover:text-gray-300">Actors</a>
                </li>
            </ul>
            <div class="flex flex-col md:flex-row items-center">
                @livewire('search-dropdown')
                <div class="md:ml-4 mt-3 md:mt-0">
                <img src="/images/avatar.png" alt="avatar" class="rounded-full w-8 h-8">
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
    @livewireScripts
    @yield('script')
</body>
</html>