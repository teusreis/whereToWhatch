<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ShowsViewModel extends ViewModel
{
    public function __construct(
        public $popularTv,
        public $topRated,
        public $genres,
    ) {
    }

    public function popularTv()
    {
        return $this->formatShows($this->popularTv);
    }

    public function topRated()
    {
        return $this->formatShows($this->topRated);
    }

    public function genres()
    {
        return  collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatShows($shows)
    {
        return collect($shows)->map(function ($show) {

            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => $show['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500/' . $show['poster_path']
                    : 'https://via.placeholder.com/250x700/',
                'vote_average' => $show['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}
