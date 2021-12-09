@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-10 px-4">

        @empty($results->toArray())
            <h2 class="text-red-500 text-lg uppercase font-semibold tracking-wider">No results found for: {{ $search }}
            </h2>
        @else

            <section id="popularActores">
                <h2 class="text-yellow-500 text-lg uppercase font-semibold tracking-wider">Results for: {{ $search }}</h2>

                <div class="flex flex-col">
                    @foreach ($results as $result)
                        <div class="mt-8 grid md:grid-cols-12 gap-4">
                            <a href="{{ route('movie.show', $result['id']) }}" class="col-span-2">
                                <img src="{{ $result['poster_path'] }}" alt="">
                            </a>

                            <div class="col-span-10">
                                <a href="{{ route('actors.show', $result['id']) }}" class="text-lg hover:text-gray-300">
                                    {{ $result['title'] }}
                                </a>

                                <p class="mt-4">
                                    {{ $result['overview'] }}
                                </p>

                                <div class="flex items-center text-gray-400 my-2">
                                    <span><i class="fas fa-star text-yellow-500"></i></span>
                                    <span class="ml-1">{{ $result['vote_average'] }}</span>
                                    <span class="mx-2">|</span>
                                    <span>
                                        {{ $result['release_date'] }}
                                    </span>
                                </div>

                                <a href="{{ $result['read_more_link'] }}" class="">
                                    <button
                                        class="mt-5 px-5 py-2 rounded bg-yellow-500 hover:bg-yellow-600 transition-all font-semibold text-black">
                                        Read more
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between mt-10">
                    @if ($previous)
                        <a href="{{ route('site.index.page', ['search' => $search, 'page' => $previous]) }}"
                            class="px-4 py-1 text-lg font-semibold rounded bg-yellow-300 text-yellow-600 hover:bg-yellow-400 hover:text-yellow-700 transition-all">
                            previous
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if ($next)
                        <a href="{{ route('site.index.page', ['search' => $search, 'page' => $next]) }}"
                            class="px-4 py-1 text-lg font-semibold rounded bg-yellow-300 text-yellow-600 hover:bg-yellow-400 hover:text-yellow-700 transition-all">
                            Next
                        </a>
                    @endif
                </div>
            </section>

        @endempty

    </div>
@endsection
