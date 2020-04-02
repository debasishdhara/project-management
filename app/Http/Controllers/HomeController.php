<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Company;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count= User::whereHas('roles', function (Builder $query) {
            $query->where('role_name', '!=', 'SUPERADMIN');
        })->count();
        $company_count = Company::count();
        return view('super.home',compact('user_count','company_count'));
    }
}
