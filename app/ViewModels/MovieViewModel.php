<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use App\Traits\RecommandationFormatTrait;

class MovieViewModel extends ViewModel
{
    use RecommandationFormatTrait;

    public function __construct(
        public $movie,
        public $recommendation,
        public $genres,
        public $providers,
    ) {
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'images' => collect($this->movie['images']['backdrops'])->take(9)
        ]);
    }
}
