@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-10 px-4">

        <section id="popularActores">
            <h2 class="text-yellow-500 text-lg uppercase font-semibold tracking-wider">Popular Actores</h2>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @foreach ($actors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show', $actor['id']) }}">
                            <img src="{{ $actor['profile_path'] }}" alt="">
                        </a>

                        <div class="mt-2">
                            <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">
                                {{ $actor['name'] }}
                            </a>
                            <div class="text-sm truncate text-gray-400">
                                {{ $actor['know_for'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between mt-10">
                @if ($previous)
                    <a href="{{ route('actors.index.page', $previous) }}" class="px-4 py-1 text-lg font-semibold rounded bg-yellow-300 text-yellow-600 hover:bg-yellow-400 hover:text-yellow-700 transition-all">
                        previous
                    </a>
                @else
                    <div></div>
                @endif

                @if ($next)
                    <a href="{{ route('actors.index.page', $next) }}" class="px-4 py-1 text-lg font-semibold rounded bg-yellow-300 text-yellow-600 hover:bg-yellow-400 hover:text-yellow-700 transition-all">
                        Next
                    </a>
                @endif
            </div>
        </section>

    </div>
@endsection
