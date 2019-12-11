<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

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
        if (auth()->user()->isAdmin == 1)
        {

            $users = User::orderBy('isAdmin', 'desc')->get();
            return view('admin.home', compact('users'));
        }
        else
        {
            $posts = Post::where('user_id', '=', auth()->user()->id)->get();
            return view('user.home', compact('posts'));
        }
    }
}
