<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use App\Traits\MovieServiceTrait;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;

class TvService
{
    use MovieServiceTrait;

    public function indexPageData(): array
    {
        $response = Http::pool(fn (Pool $pool) => [
            $pool->withToken(env('MOVIEDBAPY'))->get(env('MOVIEDBURL') . '/tv/popular'),
            $pool->withToken(env('MOVIEDBAPY'))->get(env('MOVIEDBURL') . '/tv/top_rated'),
            $pool->withToken(env('MOVIEDBAPY'))->get(env('MOVIEDBURL') . '/genre/tv/list'),
        ]);

        return $response;
    }

    public function getTvShow(int $id): array
    {
        $tvShow = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/tv/{$id}?append_to_response=credits,images,videos")
            ->json();

        return $tvShow;
    }

    public function getTvRecomandation(int $id): array
    {
        $recomandation = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/tv/{$id}/recommendations")
            ->json();

        return $recomandation;
    }

    public function getProviders(int $id): array
    {
        $providers = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/tv/{$id}/watch/providers")
            ->json()["results"];

        return count($providers) > 0
            ? $providers["US"] ?? []
            : [];
    }
}
