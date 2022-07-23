<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect(RouteServiceProvider::HOME);
    }

    public function dashboard()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }
}
