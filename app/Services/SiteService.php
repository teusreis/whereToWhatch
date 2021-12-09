<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SiteService
{

    public function search(string $query, int $page = 1): array
    {
        return Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/search/multi?query=" . $query . '&page=' . $page)
            ->json()['results'];
    }
}
