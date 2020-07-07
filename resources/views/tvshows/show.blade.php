@extends('layouts.main')

@section('content')

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto flex flex-col md:flex-row px-4 py-16">
            {{-- <div class="container mx-0"> --}}
                <img src="{{ $tvShow['poster_path'] }}" alt="poster" class=" w-64 md:w-96">
            {{-- </div> --}}
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tvShow['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-orange-300 w-4" viewBox="0 0 48 48"><g class="nc-icon-wrapper"><path fill="#EFD358" d="M43.75391,17.60889C43.59717,17.23975,43.23486,17,42.8335,17H30.63623L24.90576,4.74316 C24.74121,4.39111,24.38818,4.1665,24,4.1665s-0.74121,0.22461-0.90576,0.57666L17.36377,17H5.1665 c-0.40137,0-0.76367,0.23975-0.92041,0.60889s-0.07812,0.79639,0.20068,1.08545l9.03223,9.36719l-3.63232,14.5293 c-0.09717,0.38867,0.04688,0.79785,0.36621,1.03955s0.75244,0.26953,1.1001,0.07129L24,36.45166l12.68701,7.25 c0.1543,0.08838,0.3252,0.13184,0.49609,0.13184c0.21338,0,0.42627-0.06836,0.604-0.20312 c0.31934-0.2417,0.46338-0.65088,0.36621-1.03955L34.521,28.06152l9.03223-9.36719 C43.83203,18.40527,43.91064,17.97803,43.75391,17.60889z"/></g></svg>
                    <span class="ml-1">{{ $tvShow['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tvShow['first_air_date']}}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $tvShow['genres'] }}
                    </span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $tvShow['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach ($tvShow['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-gray-300 text-sm">{{ $crew['job'] }}</div>
                            </div>
                            @endforeach
                        </div>
                </div>
                <div x-data="{ isOpen : false }">
                    @if (count($tvShow['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                                @click = "isOpen = true"
                                class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                                <svg class="w-6 fill-current" viewBox="0 0 48 48">
                                    <g class="nc-icon-wrapper" fill="#111111">
                                        <path d="M20 33l12-9-12-9v18zm4-29C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.82 0-16-7.18-16-16S15.18 8 24 8s16 7.18 16 16-7.18 16-16 16z"/>
                                    </g>
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>

                            <div
                                x-show.transition.opacity="isOpen"
                                style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                @click="isOpen = false"
                                                @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($tvShow['casts'] as $cast)
                        <div class="mt-8">
                            <a href="{{ route('peoples.show', $cast['id'])}}">
                                <img src="{{ $cast['profile_path'] }}" alt="cast_profile" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('peoples.show', $cast['id'])}}" class="text-lg hover:text-brown-300 mt-2">
                                    {{ $cast['name'] }}
                                </a>
                                <div class="text-sm text-gray-400">
                                    {{ $cast['character'] }}
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="movie-image border-b border-gray-800" x-data="{ isOpen : false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16">
                @foreach ($tvShow['images'] as $image)
                        <div class="mt-8">
                            <a 
                            @click.prevent="
                                isOpen = true 
                                image = '{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'"
                            href="#"
                            >
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="images" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div> 
                @endforeach
            </div>
            <div
                x-show.transition.opacity="isOpen"
                style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection