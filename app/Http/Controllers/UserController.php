<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        return view('user', ['user' => $user]);
    }
}
