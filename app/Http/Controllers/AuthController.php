<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn(){
        return view('Auth.login');
    }
    public function callback(){
        return view('welcome');
    }
}
