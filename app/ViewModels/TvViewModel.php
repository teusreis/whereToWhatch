<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use App\Traits\RecommandationFormatTrait;

use function PHPSTORM_META\map;

class TvViewModel extends ViewModel
{
    use RecommandationFormatTrait;

    public function __construct(
        public $show,
        public $recommendation,
        public $genres,
        public $providers,
    ) {
    }

    public function show()
    {
        return collect($this->show)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $this->show['poster_path'],
            'vote_average' => $this->show['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->show['first_air_date'])->format('M d, Y'),
            'last_air_date' => $this->show['last_air_date']
                ? Carbon::parse($this->show['last_air_date'])->format('M d, Y')
                : 'the moment!',
            'genres' => collect($this->show['genres'])->pluck('name')->implode(', '),
            'crew' => collect($this->show['credits']['crew'])->take(2),
            // 'created_by' => collect($this->show['created_by'])->take(2),
            'images' => collect($this->show['images']['backdrops'])->take(9)
        ]);
    }
}
