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
        //get current level of logged in User
        $currentlevel = DB::table('users')->where('id', '=', Auth::id())->value('level');

        //get all user that has level lower than current level
        $data = DB::table('users')->where('level', '<', $currentlevel)->get();

        return view('home', ['users' => $data]);
    }
}
