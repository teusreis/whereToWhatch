<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class SearchViewModel extends ViewModel
{
    public function __construct(
        public $results,
        public int $page,
        public string $search,
    ) {
    }

    public function results()
    {
        return collect($this->results)->map(function ($result) {

            return collect($result)->merge([
                'poster_path' => $result['poster_path']
                    ? env('MOVIEDBIMGURL') . $result['poster_path']
                    : 'https://via.placeholder.com/500x735/',
                'title' => $result['title'] ?? $result['name'],
                'release_date' => $result['media_type'] === 'tv'
                    ? Carbon::parse($result['first_air_date'])->format('M d, Y')
                    : Carbon::parse($result['release_date'])->format('M d, Y'),
                'read_more_link' => $result['media_type'] === 'tv'
                    ? route('tv.show', $result['id'])
                    : route('movie.show', $result['id']),
                'vote_average' => $result['vote_average'] * 10 . '%',
            ]);
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }

    public function search()
    {
        return $this->search;
    }
}
