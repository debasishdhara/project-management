<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use App\SubCity;

class LocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super-admin');
    }

    public function show_country(){
        // $Country = Country::with(['state','state.city','state.city.subcity'])->get();
        return view('super.country.index');
    }

    public function show_state(){
        // $State = State::with(['city','city.subcity','country'])->get();
        return view('super.state.index');
    }

    public function show_city(){
        $totalData = City::count();
        // $City = City::with(['subcity','state','state.country'])->get();
        return view('super.city.index');
    }

    public function show_sub_city(){
        // $SubCity = SubCity::with(['city','city.state','city.state.country'])->get();
        return view('super.subcity.index');
    }
}
