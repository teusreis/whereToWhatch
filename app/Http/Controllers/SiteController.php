<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use App\ViewModels\SearchViewModel;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{
    private SiteService $siteService;

    public function __construct()
    {
        $this->siteService = new SiteService();
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $search, int $page = 1)
    {
        $results = collect($this->siteService->search($search, $page))
            ->filter(fn ($r) => $r['media_type'] === 'movie' || $r['media_type'] === 'tv');

        $viewModel = new SearchViewModel($results, $page, $search);

        return view('site.index', $viewModel);
    }
}
