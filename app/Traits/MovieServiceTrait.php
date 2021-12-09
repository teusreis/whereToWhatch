<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait MovieServiceTrait
{
    public function getGeneres()
    {
        $generes = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . '/genre/movie/list')
            ->json();

        return $generes;
    }
}
