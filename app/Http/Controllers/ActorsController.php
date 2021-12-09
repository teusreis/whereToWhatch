<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        $actors = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL')  . '/person/popular?page=' . $page)
            ->json()['results'];

        $viewModel = new ActorsViewModel($actors, $page);

        return view('actors.index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/person/{$id}")
            ->json();

        $social = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/person/{$id}/external_ids")
            ->json();

        $credits = Http::withToken(env('MOVIEDBAPY'))
            ->get(env('MOVIEDBURL') . "/person/{$id}/combined_credits")
            ->json()['cast'];

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('actors.show', $viewModel);
    }
}
