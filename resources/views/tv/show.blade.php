@extends('layouts.main')

@section('content')
    <section id="movie-info" class="md:flex border-b container px-4 py-10 mx-auto border-gray-800">
        <img src="{{ $show['poster_path'] }}" alt="" class="sm:w-full md:w-96 md:object-none">
        <div class="md:ml-10 lg:ml-24">
            <h2 class="text-4xl text-semibold mt-5">
                {{ $show['name'] }}
            </h2>
            <div class="flex items-center text-gray-400 my-3">
                <span><i class="fas fa-star text-yellow-500"></i></span>
                <span class="ml-1">
                    {{ $show['vote_average'] }}
                </span>
                <span class="mx-2">|</span>
                <span>
                    {{ $show['first_air_date'] }}
                    until
                    {{ $show['last_air_date'] }}
                </span>
                <span class="mx-2">|</span>
                <span class="">
                    {{ $show['genres'] }}
                </span>
            </div>
            <p class="text-gray-300 my-10">
                {{ $show['overview'] }}
            </p>
            <div>
                <h4 class="text-white font-semibold">Creators</h4>
                <div class="flex mt-4">
                    @if (!empty($show['created_by']))
                        @foreach ($show['created_by'] as $creator)
                            <div class="mr-5">
                                <div>
                                    {{ $creator['name'] }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="my-2">
                <h4 class="text-white font-semibold mb-2">Providers</h4>

                @forelse($providers as $key => $value)
                    <h2 class="mb-2">{{ $key }}</h2>

                    <div class="flex gap-5">
                        @foreach ($value as $p)
                            <img src="{{ $p['logo_path'] }}" alt="" width="50" height="50">
                        @endforeach
                    </div>
                @empty
                    <div>
                        No providers available for this tv show
                    </div>

                @endforelse

            </div>

            <div class="mt-10" x-data="{modalOpen: false}">
                @if (!empty($show['videos']['results']))
                    <button x-on:click="modalOpen = true" target="_blank"
                        class="px-5 py-4 rounded bg-yellow-500 hover:bg-yellow-600 transition-colors text-gray-900 font-semibold">
                        <i class="fas fa-play-circle mr-1"></i>
                        Play Trailer
                    </button>
                @endif

                @if (!empty($show['videos']['results']))
                    <div style="background: rgba(0, 0, 0, 0.5)"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        x-show.transition.opacity="modalOpen">

                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button class="text-3xl leading-none hover:text-gray-300"
                                        x-on:click="modalOpen = false; stopVideo()">&times;</button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                    <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                        <iframe width="560" height="315" id="ytTrailer"
                                            class="rasponsive-iframe absolute top-0 left-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $show['videos']['results'][0]['key'] }}"
                                            frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="show-cast" class="container px-4 py-10 mx-auto">
        <h2 class="text-lg uppercase font-semibold tracking-wider ">Recomandation</h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($recommendation as $tvShow)

                <x-tv-card :show="$tvShow" />

            @endforeach
        </div>

    </section>

    <section id="show-cast" class="container px-4 py-10 mx-auto">
        <h2 class="text-lg uppercase font-semibold tracking-wider ">Cast</h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($show['credits']['cast'] as $cast)
                @if ($loop->index > 9) @break @endif

                <div class="mt-8">
                    <a href="{{ route('actors.show', $cast['id']) }}" class="">
                        <img src="{{ env('MOVIEDBIMGURL') . $cast['profile_path'] }}" alt="" class="hover:opacity-75">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">
                            {{ $cast['name'] }}
                        </a>
                        <div class="text-sm text-gray-400">
                            {{ $cast['character'] }}
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </section>

    <section id="show-images" class="container px-4 py-10 mx-auto" x-data="{ modalImage: false, img: '' }">
        <h2 class="text-lg uppercase font-semibold tracking-wider ">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            @foreach ($show['images'] as $image)
                <div class="mt-8">
                    <a href="#"
                        x-on:click.prevent="modalImage = true; img = '{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}" alt=""
                            class="hover:opacity-75">
                    </a>
                </div>
            @endforeach
        </div>

        @if (!empty($show['videos']['results']))
            <div style="background: rgba(0, 0, 0, 0.5)"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show.transition.opacity="modalImage">

                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button class="text-3xl leading-none hover:text-gray-300" x-on:click="modalImage = false"
                                x-on:keydown.escape.window="modalImage = false">
                                &times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="img" alt="" class="w-full">
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </section>

@endsection


@push('script')
    <script>
        function stopVideo() {
            var iframe = document.querySelector('#ytTrailer');
            var iframeSrc = iframe.src;
            iframe.src = iframeSrc;
        }
    </script>
@endpush
