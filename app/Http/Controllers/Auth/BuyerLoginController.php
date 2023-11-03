<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Config;
Use Session;
use Illuminate\Support\Facades\Cookie;

class BuyerLoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required'
        ]);   
        
        $data = array('Username'=>$request->username,'Password'=>$request->password);
       
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'BuyerLogin?'.$vars)->json();
       
        if($response['ID'] == 0)
        {
            return back()->with('error', 'Username or Password is Wrong!');
        }
        $request->session()->put('user',$request->username);
        

        $request->session()->put('user_data',$response);
        $request->session()->put('buyer_login', 1);

        

        return redirect('/');

    }

    public function registration(Request $request)
    {
        $data = array('CompanyName'=>$request->CompanyName,'ContactNo'=>$request->ContactNo,'ContactName'=>$request->ContactName,
        'Username'=>$request->Username,'Password'=>$request->Password);
        
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'RegisterBuyer?'.$vars)->json();

        $data = array('Username'=>$request->Username,'Password'=>$request->Password);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'BuyerLogin?'.$vars)->json();

        return back()->with('message', 'Your account is created successfully!');

    }
}
