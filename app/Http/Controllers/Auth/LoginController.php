<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Session;

class LoginController extends Controller
{
    //
    public function logout()
    {
        Session::flush();
        return redirect('/');

    }
}
