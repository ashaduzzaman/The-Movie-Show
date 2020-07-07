@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-peoples">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Peoples</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($popularPeoples as $people)
                <div class="people mt-4">
                    <a href="{{ route('peoples.show', $people['id'])}}">
                    <img src="{{ $people['profile_path'] }}" alt="profile image"
                         class="hover:opacity-75 transition ease-in-out duration-150"
                         >
                    </a>
                    <div class="mt-2">
                    <a href="{{ route('peoples.show', $people['id'])}}" class="text-lg hover:text-gray-300">{{ $people['name'] }}</a>
                        <div class="mt-2 text-sm truncate text-gray-400">{{ $people['known_for'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <p class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</p>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>

        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/peoples/page/{{ $previous}}">Previous</a>
            @else
                <div></div>
            @endif

            @if ($next)
                <a href="/peoples/page/{{ $next }}">Next</a>
            @else
                <div></div>
            @endif
        </div> --}}
    </div>    
@endsection

@section('script')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {
    // options
    path: '/peoples/page/@{{#}}',
    append: '.people',
    // history: false,
    status: '.page-load-status'
    });
</script>    
@endsection