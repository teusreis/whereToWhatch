<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public function __construct(
        public $actor,
        public $social,
        public $credits,
    ) {
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'profile_path' => $this->actor['profile_path']
                ? env('MOVIEDBIMGURL') . $this->actor['profile_path']
                : 'https://ui-avatars.com/api/?size=500&name=' . $this->actor['name'],
            'biography' => explode("\n", $this->actor['biography']),
            'birthday' => "{$this->actor['birthday']}" . " ( " . Carbon::parse($this->actor['birthday'])->diffInYears(Carbon::now()) . " Years old)"
        ]);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'facebook' => $this->social['facebook_id'] ? 'https://www.facebook.com/' . $this->social['facebook_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://www.instagram.com/' . $this->social['instagram_id'] : null,
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null
        ]);
    }

    public function credits()
    {
        return collect($this->credits)->map(function ($movie) {
            if ($movie['media_type'] === 'tv') {
                $title = $movie['name'];
            } else if ($movie['media_type'] === 'movie') {
                $title = $movie['title'];
            } else {
                $title = 'untitled';
            }

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? env('MOVIEDBIMGURL') . $movie['poster_path']
                    : 'https://via.placeholder.com/500x735',
                'title' => $title,
            ]);
        })->sortByDesc('release_date')->take(10);
    }
}
