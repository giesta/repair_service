<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Device;
use Auth;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->hasRole('Klientas'))
        {
            $devices = Device::where('owner_id', Auth::user()->id)->latest()->paginate(5);
            return view('home', compact('devices'));
        }
        else{
            return view('home');
        }
        
    }
}
