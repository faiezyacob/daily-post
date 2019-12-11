<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->user_id = auth()->user()->id;
        $user->save();

        $users = User::orderBy('isAdmin', 'desc')->get();

        return view('admin.home', compact('users'))->with('message', 'User has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', '=', $id)->get();
        // dd($user);

        return view('admin.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $user->email = $request->get('email');
        $user->save();

        $users = User::orderBy('isAdmin', 'desc')->get();
        return view('admin.home', compact('users'))->with('message', 'Information has been updated');
    }

    public function updatepassword(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->get();
        foreach ($user as $row)
        {
            if (Hash::check ($request->get('oldpassword'), $row->password))
            {
                $user = User::findorFail($id);
                $user->password = Hash::make($request->get('newpassword'));
                $user->save();


                $users = User::orderBy('isAdmin', 'desc')->get();
                return view('admin.home', compact('users'))->with('message', 'Password has been changed');
            }
            else
                return redirect()->back()->with('error', 'The current password is incorrect');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findorFail($id);
        $user->delete();

        $users = User::orderBy('isAdmin', 'desc')->get();
        return view('admin.home', compact('users'))->with('message', 'User has been deleted');
    }
}
