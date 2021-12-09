<div class="mt-8">
    <a href="{{ route('movie.show', $movie['id']) }}" class="">
        <img src="{{ $movie['poster_path'] }}" alt="" class="hover:opacity-75">
    </a>
    <div class="mt-2">
        <a href="{{ route('movie.show', $movie['id']) }}"
            class="text-lg mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
        <div class="flex items-center text-gray-400">
            <span><i class="fas fa-star text-yellow-500"></i></span>
            <span class="ml-1">{{ $movie['vote_average'] }}</span>
            <span class="mx-2">|</span>
            <span>
                {{ $movie['release_date'] }}
            </span>
        </div>
        @isset($movie['genres'])
            <div class="text-gray-400">
                {{ $movie['genres'] }}
            </div>
        @endisset
    </div>
</div>
