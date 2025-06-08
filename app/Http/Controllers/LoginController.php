<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function retrieveLogin() {
        return view('login');
    }

    public function handleLogin(LoginRequest $request) {
        Log::info('LoginController login ====> START-INFO');

        $username = $request->input('username');
        $password = $request->input('password');

        //dd($request);

        dd("LOGIN");

        // return $request;
        Log::info('LoginController login ====> END-INFO');
    }
}
