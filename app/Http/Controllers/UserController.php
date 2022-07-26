<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registration(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|confirmed',
            'password' => 'required|confirmed|min:6',
        ]);

        return User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'rememberMe' => 'required|boolean'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->rememberMe)) {
            return Auth::user();
        } else {
            return response('Login failed', 422);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
