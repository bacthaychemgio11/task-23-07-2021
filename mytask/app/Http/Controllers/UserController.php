<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

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
        $data = DB::table('users')->where('level', '<', $currentlevel)->orderBy('id', 'asc')->paginate(10);

        return view('home', ['users' => $data]);

        // UPDATE FUNCTION TO RETURN VIEW
        // USE FOR REACT
        // 12/08/2021
        // return view('home');
    }

    public function getUsers()
    {
        //get current level of logged in User
        $currentlevel = DB::table('users')->where('id', '=', Auth::id())->value('level');

        //get all user that has level lower than current level
        $data = DB::table('users')->where('level', '<', $currentlevel)->orderBy('id', 'asc')->get();

        // return response in json type
        return response()->json(['data' => $data], 200);
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

        // VALIDATION DATA AND NOTICE IF THERE IS ERROR USING VALIDATE METHOD
        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        //     'level' => 'required|max:5|min:0'
        // ]);

        // DB::table('users')->insert(
        //     [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => $request->password,
        //         'level' => $request->level,
        //     ]
        // );

        // // ADD STATUS MESSAGE: CREATE SUCCESSFULLY
        // Session::flash('status-create', 'Create user successfully!');

        // // CREATE SUCCESSFUL STATUS JSON FOR AJAX
        // //04/08/2021
        // //ho si hung
        // return response()->json(['status' => 'successful'], 200);

        // return redirect('home');


        //-------------------------------------------------------------------
        // VALIDATION DATA AND NOTICE ERROR USING VALIDATOR FACADE FOR SUPPORT AJAX REQUEST
        // ho si hung
        // 05/08/2021
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'level' => 'required|between:0,5|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {

            DB::table('users')->insert(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'level' => $request->level,
                ]
            );

            return response()->json(['status' => 'successful', 'message' => 'Add user successfuly!'], 200);
        }
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
    public function edit(Request $request)
    {
        $data = DB::table('users')->where('id', '=', $request->id)->first();

        return response()->json(['data' => $data], 200);
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
        // 06/08/2021
        //UPDATE FUCNTION FOR AJAX
        // HO SI HUNG

        // VALIDATION DATA AND NOTICE IF THERE IS ERROR
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'level' => 'required|between:0,5|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            // UPDATE INFORMATION FOR USER
            DB::table('users')
                ->where('id', $request->id)
                ->update(['name' => $request->name, 'email' => $request->email, 'level' => $request->level]);

            return response()->json(['status' => 'successful', 'message' => 'Edit user successfuly!', 'oldData' => $request->all()], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('users')->where('id', '=', $request->id)->delete();

        return response()->json(['status' => 'successful', 'message' => 'Delete user successfuly!'], 200);
    }
}
