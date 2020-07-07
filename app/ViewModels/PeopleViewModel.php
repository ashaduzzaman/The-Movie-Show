<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class PeopleViewModel extends ViewModel
{

    public $people;
    public $credits;
    public $social;

    public function __construct($people,$credits,$social)
    {
        $this->people = $people;
        $this->credits = $credits;
        $this->social = $social;
    }

    public function people()
    {
        return collect($this->people)->merge([
            // 'profile_path' => 'https://image.tmdb.org/t/p/w500/'.$this->people['profile_path'],
            'profile_path' => $this->people['profile_path'] 
                ? 'https://image.tmdb.org/t/p/w300/'.$this->people['profile_path'] 
                : 'https://via.placeholder.com/300x450',
            'birthday' => Carbon::parse($this->people['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->people['birthday'])->age,
        ]);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://www.twitter.com/'.$this->social['twitter_id']  : null,
            'facebook' => $this->social['facebook_id'] ? 'https://www.facebook.com/'.$this->social['facebook_id']  : null,
            'instagram' => $this->social['instagram_id'] ? 'https://www.instagram.com/'.$this->social['instagram_id']  : null,
        ]);
    }

    public function knownFortitles()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->sortByDesc('popularity')->take(5)->map(function($castTitle){

            if(isset($castTitle['title'])){
                $title = $castTitle['title'];
            }
            elseif(isset($castTitle['name'])){
                $title = $castTitle['name'];
            }
            else{
                $title = '';
            }

            return collect($castTitle)->merge([
                'poster_path' => $castTitle['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$castTitle['poster_path']
                : 'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $castTitle['media_type'] == 'movie' ? route('movies.show', $castTitle['id']) : route('tvshows.show', $castTitle['id'])
            ]);
        });
    }

    public function credits()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->map(function($movie){

            if(isset($movie['release_date'])){
                $release_date = $movie['release_date'];
            }
            elseif(isset($movie['first_air_date'])){
                $release_date = $movie['first_air_date'];
            }
            else{
                $release_date = '';
            }

            if(isset($movie['title'])){
                $title = $movie['title'];
            }
            elseif(isset($movie['name'])){
                $title = $movie['name'];
            }
            else{
                $title = '';
            }

            return collect($movie)->merge([
                
                'release_date' => $release_date,
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
                'release_year' => isset($release_date) ? Carbon::parse($release_date)->format('Y') : 'Future'

            ]);
        })
        ->sortByDesc('release_date');
    }
}
