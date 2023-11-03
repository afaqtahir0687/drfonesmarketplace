<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Config;
use Carbon\Carbon;
use App\Models\Comments;
use App\Models\Subscribe;
use App\Mail\BookingEmail;
use App\Exports\BulkExport;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;


class HomeController extends Controller
{
    public function index(Request $request)
    {

        $url = Config::get('app.API_URL');
        if($request->has('q') && $request->get('q') > 1)
        {
            $data['Model'] = $request->get('q');
            $vars = http_build_query($data);
            $response = Http::post($url.'InventoryLookUpName?'.$vars)->json();
        }
        else
        {
            $response = Http::post($url.'InventoryLookUp')->json();
        }
        $data['models'] = array();
        $temp = array();
        if(is_array($response))
        {
            foreach($response as $item)
            {
                if(in_array($item['UserID'],$temp))
                {
                    $data['models'][$item['UserID']]['items'][] = $item;
                }
                else
                {
                    $temp[] = $item['UserID'];
                    $data['models'][$item['UserID']]['CompanyName'] = $item['CompanyName'];
                    $data['models'][$item['UserID']]['items'][] = $item;
                }
            }
        }
        return view('frontend.index', $data);
    }
    public function search(Request $request,$model)
    {
       
        if(!$request->has('id') || empty($request->id))
        {
            abort(404);
        }
        $limit = isset($request->limit)?$request->limit:15;
        $offset = 0;
        if($request->has('page') && $request->get('page') > 1)
        {
            $offset = ($request->get('page')-1) * $limit;
        }
        $data = array('Model'=> str_replace('-',' ',$model),'USERID'=> $request->id, 'Limit' => $limit,'Offset' => $offset);

        if($request->has('min') && !empty($request->min))
        {
            $data['MinPrice'] = $request->min;
        }
        if($request->has('max') && !empty($request->max))
        {
            $data['MaxPrice'] = $request->max;
        }
        if($request->has('grade') && !empty($request->grade))
        {
            $data['Grade'] = implode(',',$request->grade);
        }
        if($request->has('carrier') && !empty($request->carrier))
        {
            $data['Carrier'] = implode(',',$request->carrier);
        }
        if($request->has('memory') && !empty($request->memory))
        {
            $data['Memory'] = implode(',',$request->memory);
        }
        if($request->has('color') && !empty($request->color))
        {
            $data['Color'] = implode(',',$request->color);
        }
        if($request->has('condition') && !empty($request->condition))
        {
            $data['Condition'] = implode(',',$request->condition);
        }
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'InventoryDetails?'.$vars)->json();
        $data['devices'] = array();
        $data['total'] = 0;
        $data['limit'] = $limit;
        if (!is_null($response) && !empty($response) && !empty($response['Data'])) {
            $data['total'] = $response['Total'];
            $data['devices'] = $response['Data'];
        }
       
        return view('frontend.products.index', $data);
    }
    public function view(Request $request)
    {
        if(!$request->has('serial') || empty($request->serial))
        {
            abort(404);
        }
        $data = array('Serial'=>$request->serial);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'SearchSerial?'.$vars)->json();
        $data['device'] = array();
        if (!is_null($response) && !empty($response) && !empty($response['Data']) && isset($response['Data'][0]) && is_array($response['Data'][0])) {
            $data['device'] = $response['Data'][0];
        }
        else
        {
            abort(404);
        }

        $data['comments'] = Comments::where('imei',$data['device']['Imei'])->orderBy('id', 'desc')->get();

        $avg_ratings = Comments::where('imei',$data['device']['Imei'])->selectRaw('SUM(rating)/COUNT(imei) AS avg_rating')->first()->avg_rating;

        $data['avg_ratings'] = round($avg_ratings, 1);
        $data['avg_percentage'] = $data['avg_ratings'] * 2 * 10;
        return view('frontend.products.view', $data);
    }

    public function freeDemo(Request $request)
    {
        $data = array('Payload' => json_encode(array('name'=>$request->name,'phone'=>$request->ContactNo,'email'=>$request->email,
        'company_name'=>$request->company_name,'country'=>$request->country,'devices'=>$request->devices
        ,'testing_software'=>$request->testing_software)));

        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'DemoRequest?'.$vars)->json();
        return redirect('/free-demo')->with('message', 'Your request has been submited.');
    }


    public function testimonials(Request $request)
    {
        $data = array('Payload' => json_encode(array('name'=>$request->name,'phone'=>$request->ContactNo,'email'=>$request->email,
        'company_name'=>$request->company_name,'country'=>$request->country,'devices'=>$request->devices
        ,'testing_software'=>$request->testing_software)));

        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'DemoRequest?'.$vars)->json();
        return redirect('/testimonials')->with('message', 'Your request has been submited.');
    }

    public function imiverification(Request $request)
    {
        $data = array('Payload' => json_encode(array('name'=>$request->name,'phone'=>$request->ContactNo,'email'=>$request->email,
        'company_name'=>$request->company_name,'country'=>$request->country,'devices'=>$request->devices
        ,'testing_software'=>$request->testing_software)));

        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'DemoRequest?'.$vars)->json();
        return redirect('/imiverification')->with('message', 'Your request has been submited.');
    }
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email'
        ]);
        Subscribe::create($data);
        return json_encode(['status'=>true]);
    }

    public function sendBookingEmail(Request $request)
    {
        // dd($request->all());
        try
        {
            $data = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'country' => $request->country,
                'date' => $request->date,
                'time' => $request->time,
            ];
    
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'drfonesteam@gmail.com';
            $mail->Password = 'umcifegtjtruomjw';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('drfonesteam@gmail.com', 'DrFones MarketPlace');
            $mail->addAddress('mahashamaoon10@gmail.com', 'DrFones Ltd');
            $mail->Subject = 'Booking Detail For Upcoming Event';
            $mail->Body = "Dear Team,\nI would like to share the booking details of an upcoming appointment. The details are as follows:\n".
                    "Full Name: {$data['full_name']}\n" .
                  "Email: {$data['email']}\n" .
                  "Company Name: {$data['company_name']}\n" .
                  "Country: {$data['country']}\n" .
                  "Date: {$data['date']}\n" .
                  "Time: {$data['time']}\n" ;
                  
            $mail->SMTPDebug = 2;
            $mail->send();
    
            return back()->with('message','Booking Email Sent Successfully.');
        }catch(\Exception $exception)
        {
            return back()->with('error','Server Error.');
        }
    }

}




