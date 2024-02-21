<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Country;

class HomeController
{
    public function index()
    {
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('frontend.home', compact('countries'));
    }
}
