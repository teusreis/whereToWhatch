<?php

namespace App\Traits;

use Carbon\Carbon;

trait RecommandationFormatTrait
{
    public function genres()
    {
        return  collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    public function recommendation()
    {
        return collect($this->recommendation)->map(function ($movie) {

            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path']
                    : 'https://via.placeholder.com/250x700/',
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => $movie['media_type'] === 'tv'
                    ? Carbon::parse($movie['first_air_date'])->format('M d, Y')
                    : Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ]);
        })->take(10);
    }

    public function providers()
    {
        return collect($this->providers)
            ->except(["link"])
            ->map(function ($provider) {
                return collect($provider)->map(function ($p) {
                    return collect($p)->merge([
                        "logo_path" => env('MOVIEDBIMGURL') . $p["logo_path"]
                    ]);
                });
            })->toArray();
    }
}
