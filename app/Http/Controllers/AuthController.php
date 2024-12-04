<?php

namespace App\Http\Controllers;

use App\Actions\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn(){
        return view('Auth.login');
    }
    public function index(User $user){

        return view('pages.index');
    }
}
