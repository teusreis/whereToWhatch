<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use App\Services\MovieService;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    private MovieService $movieService;

    public function __construct()
    {
        $this->movieService = new MovieService();
    }

    public function index()
    {
        $response = $this->movieService->indexPageData();

        $popularMovies = $response[0]->json()['results'];
        $nowPlaying = $response[1]->json()['results'];
        $genres = $response[2]->json()['genres'];

        $viewModel = new MoviesViewModel($popularMovies, $nowPlaying, $genres);

        return view('movie.index', $viewModel);
    }

    public function show(int $id)
    {
        $movie = $this->movieService->getMovie($id);

        $recommendation = $this->movieService->getMovieRecomandation($movie['id'])['results'];

        $providers = $this->movieService->getProviders($movie['id']);

        $genres = $this->movieService->getGeneres()['genres'];

        $viewModel = new MovieViewModel($movie, $recommendation, $genres, $providers);

        return view('movie.show', $viewModel);
    }
}
