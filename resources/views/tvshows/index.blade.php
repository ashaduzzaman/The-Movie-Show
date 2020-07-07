@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($popularTvShows as $tvshow)
            {{-- <p>{{ $tvshow['name'] }}</p> --}}
                    <x-tv-show-card :tvshow="$tvshow"/>
                @endforeach
            </div>
        </div>
        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top rated Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($topRatedTvShows as $tvshow)
                    <x-tv-show-card :tvshow="$tvshow"/>
                @endforeach
            </div>
        </div>
    </div>    
@endsection