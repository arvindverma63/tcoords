<?php

namespace App\Actions;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class User{
    public function getUser(){
        $id = Session::get('user_id');
        $token = Session::get('token');
        $baseUrl = env('API_BASE_URL');
        $response = Http::withHeaders([
            'Authorization'=>'Bearer'.$token,
        ])->get($baseUrl.'/profile/'.$id);
        $data = $response->json();
        return $data;
    }
}
