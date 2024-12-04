<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function getTeam(){
        return view('pages.team');
    }
}
