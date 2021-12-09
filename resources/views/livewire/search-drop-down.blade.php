<div class="relative" x-data="{ isOpen: true }" x-on:click.away="isOpen = false">
    <input type="text"
        wire:model='search'
        name="search"
        id="search"
        class="py-1 px-3 rounded-l-full bg-gray-600 outline-none focus:shadow-lg"
        placeholder="Search"
        x-on:focus="isOpen = true">

    <button wire:click="goToSearch" type="button" class="bg-gray-600 rounded-r-full py-1 px-3">
        <i class="fas fa-search"></i>
    </button>

    @if(strlen($search) !== 0)

        @if (!empty($results))

            <div x-show.transition.opacity="isOpen" class="z-index-50 absolute w-full bg-gray-600 mt-3 rounded-lg" x-on:keydown.escape.window="isOpen = false">

                @foreach ($results as $result)

                    <div class="grid grid-cols-12 gap-2 border-b border-gray-700 px-3 py-2">
                        @if ($result['media_type'] === 'movie')
                            <a href="{{ route('movie.show', $result['id']) }}" class="col-span-3">
                                <img src="{{ env('MOVIEDBIMGURL') . $result['poster_path'] }}"
                                    alt="movie poster"
                                    class="">
                            </a>

                            <div class="col-span-7">
                                <a href="{{ route('movie.show', $result['id']) }}">
                                    {{ $result['title'] }}
                                </a>
                            </div>
                        @else
                            <a href="{{ route('tv.show', $result['id']) }}" class="col-span-3">
                                <img src="{{ env('MOVIEDBIMGURL') . $result['poster_path'] }}"
                                    alt="movie poster"
                                    class="">
                            </a>

                            <div class="col-span-7">
                                <a href="{{ route('tv.show', $result['id']) }}">
                                    {{ $result['name'] }}
                                </a>
                            </div>
                        @endif
                    </div>

                    @if ($loop->index === 7) @break @endif
                @endforeach
            </div>
        @else

            <div class="absolute w-full bg-gray-600 mt-3 rounded-lg px-3 py-2">
                No results for: {{ $search }}
            </div>

        @endif

    @endif

</div>
