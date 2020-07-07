<?php

namespace App\Http\Controllers;

use App\ViewModels\PeoplesViewModel;
use App\ViewModels\PeopleViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeoplesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
        $popularPeoples = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
        ->json()['results'];

        $viewModel = new PeoplesViewModel($popularPeoples, $page);
        
        return view('peoples.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $people = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id)
        ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
        ->json();

        $socials = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')
        ->json();

        $viewModel = new PeopleViewModel($people, $credits, $socials);
        
        return view('peoples.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
