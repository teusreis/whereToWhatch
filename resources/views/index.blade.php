@extends('layouts.main')

@section('content')

<div class="container mx-auto px-4 py-10">

    <section id="popularMovier">
        <h2 class="text-yellow-500 text-lg uppercase font-semibold tracking-wider">Popular Movies</h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach ($popularMovies as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"></x-movie-card>
            @endforeach
        </div>
    </section>

    <section id="nowPlaying">
        <h2 class="text-yellow-500 text-lg uppercase font-semibold tracking-wider mt-10">Now Playing</h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($nowPlaying as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"></x-movie-card>
            @endforeach
        </div>
    </section>

</div>

@endsection
