<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Config;
Use Session;
use Illuminate\Support\Facades\Cookie;



class SellerLoginController extends Controller
{
    public function index(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required'
        ]);   

        $url = Config::get('app.API_URL');
        $data = array('Name' => $request->username,'Password' => $request->password);
        $vars = http_build_query($data);
       
        $response = Http::post($url.'Login?'.$vars);
        if(!empty($response->body()) && $response->body() != 'User not Found')
        {
            
            // $url = 'http://3.20.74.120:7070/';
            // $data = array('UserID' => $response->body());
            // $vars = http_build_query($data);

            $username = Http::post($url.'getUserName?'.$vars);
            $request->session()->put('user',$response->body());
            $request->session()->put('username',$request->username);
            
            return redirect('devices/unposted');
        } 
        else 
        {
            return back()->with('error', 'Username or Password is Wrong!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');

    }
}
