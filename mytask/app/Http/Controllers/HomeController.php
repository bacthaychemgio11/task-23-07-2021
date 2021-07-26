<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $currentlevel = DB::table('users')->where('id', '=', Auth::id());
        
        $data = DB::table('users')->where('level', '<=', 3)->get();

        // $data = DB::table('users')->get();

        return view('home', ['users' => $data]);
    }
}
