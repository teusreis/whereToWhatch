<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public function __construct(
        public $actors,
        public int $page
    ) {
    }

    public function actors()
    {
        return collect($this->actors)->map(function ($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? env('MOVIEDBIMGURL') . $actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=500&name=' . $actor['name'],
                'know_for' => collect($actor['known_for'])
                    ->where('media_type', 'movie')
                    ->pluck('title')
                    ->union(collect($actor['known_for'])
                        ->where('media_type', 'tv')
                        ->pluck('name'))
                    ->implode(', ')
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
}
