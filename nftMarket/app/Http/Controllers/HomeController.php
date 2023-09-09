<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $nfts = Nft::where('proprietaire_id', Auth::id())->get();
        return view('home')->with('nfts', $nfts);
        // return view('home');
    }
}
