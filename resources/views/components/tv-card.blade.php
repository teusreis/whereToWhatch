<div class="mt-8">
    <a href="{{ route('tv.show', $show['id']) }}" class="">
        <img src="{{ $show['poster_path'] }}" alt="" class="hover:opacity-75">
    </a>
    <div class="mt-2">
        <a href="{{ route('tv.show', $show['id']) }}"
            class="text-lg mt-2 hover:text-gray-300">{{ $show['name'] }}</a>
        <div class="flex items-center text-gray-400">
            <span><i class="fas fa-star text-yellow-500"></i></span>
            <span class="ml-1">{{ $show['vote_average'] }}</span>
            <span class="mx-2">|</span>
            <span>
                {{ $show['first_air_date'] }}
            </span>
        </div>
        <div class="text-gray-400">
            {{ $show['genres'] }}
        </div>
    </div>
</div>
