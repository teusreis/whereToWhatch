<nav class="border-b border-gray-800">
    <div class="container mx-auto flex flex-col md:flex-row justify-between py-6 px-4 items-center">
        <div class="flex items-center">
            <h1 class="mr-14 text-2xl ">
                <img src="{{ asset('img/logo.svg') }}" class="inline-block text-white" alt="Logo">
                <a href="{{ route('home') }}">ToWatch</a>
            </h1>

            <div>
                <a href="{{ route('movie.index') }}" class="px-3 py-2 hover:text-gray-400 transition-colors">Movies</a>
                <a href="{{ route('tv.index') }}" class="px-3 py-2 hover:text-gray-400 transition-colors">Tv Shows</a>
                <a href="{{ route('actors.index') }}"
                    class="px-3 py-2 hover:text-gray-400 transition-colors">Actors</a>
            </div>
        </div>
        <div class="flex items-center">
            @livewire('search-drop-down')
        </div>
    </div>
</nav>
