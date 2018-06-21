<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // add

class UsersController extends Controller
{
//index-------------------------------------------------------------------------------------------------
    public function index()
    {
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }

//show-------------------------------------------------------------------------------------------------
    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }

//followings--------------------------------------------------------------------------------------------    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

//followers-------------------------------------------------------------------------------------------------------
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
//favorite------------------------------------------------------------------------
    public function favoritings($id)
    {
        $micropost = Micropost::find($id);
        $favoritings = $micropost->favoritings()->paginate(10);

        $data = [
            'micropost' => $micropost,
            'micropost' => $favoritings,
        ];

        $data += $this->counts($micropost);

        return view('favorite.favoritings', $data);
    }
}
