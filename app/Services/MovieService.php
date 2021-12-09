<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use App\Traits\MovieServiceTrait;
use Illuminate\Support\Facades\Http;

class MovieService
{
    use MovieServiceTrait;

    public function indexPageData()
    {
        $response = Http::pool(fn (Pool $pool) => [
            $pool->withToken(env('MOVIEDBAPY'))->get(env('MOVIEDBURL') . '/movie/popular'),
            $pool->withToken(env('MOVIEDBAPY'))->get(env('MOVIEDBURL') . '/movie/now_playing'),
            $pool->withToken(env('MOVIEDBAPY'))->get(env('MOVIEDBURL') . '/genre/movie/list'),
        ]);

        return $response;
    }

    public function getMovie(int $id)
    {
        $movie = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/movie/{$id}?append_to_response=credits,videos,images")
            ->json();

        return $movie;
    }

    public function getMovieRecomandation(int $id): array
    {
        $movies = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/movie/{$id}/recommendations")
            ->json();

        return $movies;
    }

    public function getProviders(int $id): array
    {
        $providers = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/movie/{$id}/watch/providers")
            ->json()["results"];

        return count($providers) > 0
            ? $providers["US"] ?? []
            : [];
    }
}
