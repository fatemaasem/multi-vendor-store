<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class UserController extends Controller 
{
    //
    public function index(){
        return view('user.dashboard');
    }
}
