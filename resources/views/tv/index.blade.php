@extends('layouts.main')

@section('content')

<div class="container mx-auto px-4 py-10">

    <section id="popularTv">
        <h2 class="text-yellow-500 text-lg uppercase font-semibold tracking-wider">Popular Shows</h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach ($popularTv as $show)
                <x-tv-card :show="$show" :genres="$genres"></x-tv-card>
            @endforeach
        </div>
    </section>

    <section id="nowPlaying">
        <h2 class="text-yellow-500 text-lg uppercase font-semibold tracking-wider mt-10">Top rated show</h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($topRated as $show)
                <x-tv-card :show="$show" :genres="$genres"></x-tv-card>
            @endforeach
        </div>
    </section>

</div>

@endsection
