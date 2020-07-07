<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowsViewModel extends ViewModel
{

    public $popularTvShows;
    public $topRatedTvShows;
    public $genres;
    

    public function __construct($popularTvShows, $topRatedTvShows, $genres)
    {
        $this->popularTvShows = $popularTvShows;
        $this->topRatedTvShows = $topRatedTvShows;
        $this->genres = $genres;

    }

    public function popularTvShows()
    {
        return $this->formatTvShows($this->popularTvShows);
    }

    public function topRatedTvShows()
    {
        return $this->formatTvShows($this->topRatedTvShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTvShows($tvShows)
    {
        return collect($tvShows)->map(function($tvShows){
            $genresFormatted = collect($tvShows['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvShows)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tvShows['poster_path'],
                'vote_average' => $tvShows['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvShows['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}
