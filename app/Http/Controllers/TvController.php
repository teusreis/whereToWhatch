<?php

namespace App\Http\Controllers;

use App\Services\TvService;
use App\ViewModels\TvViewModel;
use App\ViewModels\ShowsViewModel;

class TvController extends Controller
{
    private TvService $tvService;

    public function __construct()
    {
        $this->tvService = new TvService();
    }

    public function index()
    {

        $response = $this->tvService->indexPageData();

        $popularTv = $response[0]->json()['results'];
        $topRated = $response[1]->json()['results'];
        $genres = $response[2]->json()['genres'];

        $viewModel = new ShowsViewModel($popularTv, $topRated, $genres);

        return view('tv.index', $viewModel);
    }

    public function show(int $id)
    {
        $show = $this->tvService->getTvShow($id);

        $recommendation = $this->tvService->getTvRecomandation($show['id'])['results'];

        $providers = $this->tvService->getProviders($show['id']);

        $genres = $this->tvService->getGeneres()['genres'];

        $viewModel = new TvViewModel($show, $recommendation, $genres, $providers);

        return view('tv.show', $viewModel);
    }
}
