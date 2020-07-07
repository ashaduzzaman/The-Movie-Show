<div class="relative  mt-3 md:mt-0" x-data = "{ isOpen : true}" @click.away="isOpen = false">
    <input wire:model.debounce.500ms ="search" type="text" 
    class="bg-gray-800 rounded-full text-sm w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" 
    placeholder="Search"
    x-ref="search"
    @keydown.window ="
        if(event.keyCode == 191){
            event.preventDefault();
            $refs.search.focus();
        }
    "
    @keydown.escape.window = "isOpen = false"
    @keydown.shift.tab = "isOpen = false"
    @keydown = "isOpen = true"
    @focus="isOpen = true"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-3 text-gray-500 mt-2 ml-2" viewBox="0 0 512 512"><path class="heroicon-ui" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" /></svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
    @if (strlen($search) > 2)
        <div class="z-50 absolute text-sm bg-gray-800 rounded w-64 mt-4" x-show.transition.opacity="isOpen">
            @if ($searchResults->count() > 0)
            <ul>
                @foreach ($searchResults as $results)
                    <li class="border-b border-gray-700">
                        <a href="{{ route('movies.show', $results['id'])}}" 
                        class="block hover:bg-gray-700 flex items-center px-3 py-3"
                        @if ($loop->last) @keydown.tab.exact = "isOpen =false" @endif
                        >
                            @if ( $results['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{ $results['poster_path']}}" alt="poster" class="w-8">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                            @endif
                            <span class="ml-4">{{ $results['title'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            @else
                <div class="px-3 py-3">No Results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>