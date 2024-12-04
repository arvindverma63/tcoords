<?php

namespace App\Actions;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Session;

class User{
    public function getUser(){
        $id = Session::get('user_id');
        $response = ModelsUser::where('linkedin_id',$id)->first();
        return response()->json($response);
    }
}
