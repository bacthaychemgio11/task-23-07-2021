<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get current level of logged in User
        $currentlevel = DB::table('users')->where('id', '=', Auth::id())->value('level');

        //get all user that has level lower than current level
        $data = DB::table('users')->where('level', '<', $currentlevel)->orderBy('id','asc')->paginate(10);

        return view('home', ['users' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation không báo lỗi trên trang add-user.
        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        //     'level' => 'required|max:5|min:0'
        // ]);

        DB::table('users')->insert(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'level' => $request->level,
            ]
        );

        // ADD STATUS MESSAGE: CREATE SUCCESSFULLY
        // $request->session()->flash('status-create', 'Create user successfully!');

        return redirect('home')->with('status-create','Create user successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('users')->where('id', '=', $id)->first();

        return view('edit', ['user' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // UPDATE INFORMATION FOR USER
        DB::table('users')
            ->where('id', $request->id)
            ->update(['name' => $request->name, 'email' => $request->email, 'level' => $request->level]);

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        // CREATE A STATUS MESSAGE TO NOTICE DELETE SUCCESSFULLY
        //có vấn đề  - không xuất hiện thông báo
        // session(['delete-status' => true, 'idRemove' => $id]);

        return redirect('home');
    }
}
