<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class PeoplesViewModel extends ViewModel
{
    public $popularPeoples;
    public $page;


    public function __construct($popularPeoples, $page)
    {
        $this->popularPeoples = $popularPeoples;

        $this->page = $page;
    }

    public function popularPeoples()
    {
        return collect($this->popularPeoples)->map(function($people){
            return collect($people)->merge([
                'profile_path' => $people['profile_path'] 
                ? 'https://image.tmdb.org/t/p/w235_and_h235_face/'.$people['profile_path'] 
                : 'https://ui-avatars.com/api/?size=235&name='.$people['name'],
                'known_for' => collect($people['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($people['known_for'])->where('media_type', 'movie')->pluck('name')
                )->implode(', ')
            ]);
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
