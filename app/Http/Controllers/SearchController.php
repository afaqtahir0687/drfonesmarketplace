<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_imei(Request $request)
    {
        $data['table'] = 0;
        if($request->has('search') && !empty($request->search))
        {
            $IMEI = $request->search;
            $data = array('IMEI'=>$IMEI);
            $url = 'http://3.20.74.120:8080/';
            $vars = http_build_query($data);
            $response = Http::post($url.'GlobalLookup?'.$vars)->json();
            $data['records'] = array();
            $data['keys'] = array();
            if(!is_null($response) && !empty($response) && !empty($response['Data']))
            {
                if(isset($response['Data'][0]))
                {
                    $data['keys'] = array_keys($response['Data'][0]);
                }
                $events_arr = $response['Data'];
                usort($events_arr, function($a, $b) { 
                    return strtotime($a['Time']) - strtotime($b['Time']); 
                });
                $data['records'][] = $events_arr[count($events_arr) -1];
            }
            $data['table'] = 1;
        }
        
        return view('frontend.search-imei',$data);
    }

    public function mark_sold(Request $request)
    {
        $data = array('USERID'=>session()->get('user'),'Serial'=>$request->Serial,'Status'=>0);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $result = Http::post($url.'UpdateDevicestatus?'.$vars)->json();
        return redirect('/devices/posted')->with('message', 'Device Sold successfully.');
    }

   public function mark_sold_all(Request $request)
    {
        $serials = explode(',', $request->serial);
        for ($i=0; $i < count($serials); $i++) { 
            $data = array('USERID'=>session()->get('user'),'Serial'=>$serials[$i],'Status'=>0);

            $url = Config::get('app.API_URL');
            $vars = http_build_query($data);
            $result = Http::post($url.'UpdateDevicestatus?'.$vars)->json();
        }
        return redirect('/devices/posted')->with('message', 'Device Sold successfully.');
    }
}
