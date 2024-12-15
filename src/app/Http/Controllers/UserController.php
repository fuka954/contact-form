<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // $todos = Todo::with('category')->get();
        // $categories = Category::all();

        return view('/register');
    }

    public function store(UserRequest $request)
    {
        $user = $request->only(['name','email', 'password']);
        $user['password'] = Hash::make($user['password']);
        User::create($user);

        return redirect()->route("login");
    }
}
