<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BulkExport;
use Config;
use Carbon\Carbon;
use DB;

class DeviceController extends Controller
{
    public function get_unposted_devices(Request $request)
    {
        if(!session()->get('user') && !session()->get('user_data'))
        {
            return redirect('/');
        }

        $limit = 10;
        $offset = 0;
        if($request->has('page') && $request->get('page') > 1)
        {
            $offset = ($request->get('page')-1) * $limit;
        }

        if(isset($request->IMEI) && !is_null($request->IMEI))
        {
           
            $data = array('USERID'=>session()->get('user'),'DeviceID'=>$request->IMEI, 'Offset'=> $offset, 'Limit' => $limit);
            $url = Config::get('app.API_URL');
            $vars = http_build_query($data);
            $data['devices'] = Http::post($url.'SearchUnpostedDevices?'.$vars)->json();
            $devices = array();
            if(isset($data['devices']['Data']))
            {
                $devices = $data['devices']['Data']; 
            }
            return view('frontend.devices.unposted', get_defined_vars());
        }

        if(is_null($request->from) || is_null($request->to))
        {
            $from = date('Y-m-d');
            $to = date('Y-m-d');
        }
        else
        {
            $from = Carbon::parse($request->from)->format('Y-m-d');
            $to = Carbon::parse($request->to)->format('Y-m-d');
        }
        // 'FromDate'=>$from,'ToDate'=>$to
        $data = array('USERID'=>session()->get('user'),'FromDate'=>$from,'ToDate'=>$to, 'Offset'=> $offset, 'Limit' => $limit);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $data['devices'] = Http::post($url.'UnpostedDevices?'.$vars)->json();
        $devices = array();
        if(isset($data['devices']['Data']))
        {
            $devices = $data['devices']['Data']; 
        }
        return view('frontend.devices.unposted', get_defined_vars());
    }

    public function get_posted_devices(Request $request)
    {
        
        $limit = 10;
        $offset = 0;
        if($request->has('page') && $request->get('page') > 1)
        {
            $offset = ($request->get('page')-1) * $limit;
        }

        $data = array('USERID'=>session()->get('user'), 'Offset'=> $offset, 'Limit' => $limit);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $data['devices'] = Http::post($url.'Published?'.$vars)->json();
        $devices = array();
        if(isset($data['devices']['Data']))
        {
           
            $devices = $data['devices']['Data']; 
        }
        return view('frontend.devices.posted', get_defined_vars());
    }

    public function publish_device($serial = '')
    {
        return view('frontend.devices.publish', get_defined_vars());
    }
    public function published(Request $request)
    {
        
        $price = $request->param . ' ' . $request->price;
        
        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $i = 1;
            if ( !is_dir( public_path('images/'.$request->serial) ) ) {
                mkdir( public_path('images/'.$request->serial) );       
            }
            $image_name = $i;
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $file->move(public_path('images/'.$request->serial), $image_full_name);
        }
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $i = 2;
            if ( !is_dir( public_path('images/'.$request->serial) ) ) {
                mkdir( public_path('images/'.$request->serial) );       
            }
            foreach ($files as $file) {
                $image_name = $i;
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $file->move(public_path('images/'.$request->serial), $image_full_name);
                $i++;
            }
        }
        
        $data = array('USERID'=>session()->get('user'),'DeviceID'=>$request->serial);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $data['devices'] = Http::post($url.'SearchUnpostedDevices?'.$vars)->json();
       
        if(isset($data['devices']['Data']))
        {
            $devices = $data['devices']['Data']; 
            $serials = explode(',', $request->serial);
            
            for ($i=0; $i < count($devices); $i++) { 
                if (in_array($devices[$i]['Serial'], $serials)) {
                    $data = array(
                        'UserID'=>session()->get('user'),'UDID'=>$devices[$i]['Imei'],'ModelNo'=>$devices[$i]['ModelNo'],'ModelName'=>$devices[$i]['ModelName'],
                        'Color'=>$devices[$i]['Color'],'Memory'=>$devices[$i]['Memory'],'Carrier'=>$devices[$i]['Carrier'],'FMI'=>$devices[$i]['Fmi'],
                        'Serial'=>$devices[$i]['Serial'],'IMEI'=>$devices[$i]['Imei'],'Firmware'=>$devices[$i]['Firmware'],
                        'Version'=>$devices[$i]['Version'],'OS'=>$devices[$i]['Os'],'Fail'=>$devices[$i]['Fail'],'Pass'=>$devices[$i]['Pass'],
                        'Wipe'=>$devices[$i]['Wipe'],'JailBreak'=>$devices[$i]['Jailbreak'],'ESN'=>$devices[$i]['ESN'],
                        'ANumber'=>$devices[$i]['ANumber'],'RegionCode'=>$devices[$i]['Regioncode'],
                        'Manufacturer'=>$devices[$i]['Manufacturer'],'BatteryModel'=>$devices[$i]['Batterymodel'],
                        'DesignCapacity'=>$devices[$i]['Designcapacity'],'Comments'=>$devices[$i]['Comments'],'CurrentCapacity'=>$devices[$i]['Currentcapacity'],
                        'BatteryHealth'=>$devices[$i]['Batteryhealth'],'CycleCount'=>$devices[$i]['Cyclecount'],
                        'Temperature'=>$devices[$i]['Temperature'],'TransactionNo'=>$devices[$i]['Transactionno'],
                        'CustomerName'=>$devices[$i]['CustomerName'],'InvoiceNo'=>$devices[$i]['InvoiceNo'],'TesterName'=>$devices[$i]['TesterName'],
                        'SimLock'=>$devices[$i]['SimLock'],'isLatest'=>$devices[$i]['IsLatest'],'Time'=>$devices[$i]['Time'],
                        'Price'=>$price,'Status'=>1);
                    
                    $url = Config::get('app.API_URL');
                    $vars = http_build_query($data);
                    $result = Http::post($url.'RegisterMarketPlaceDevice?'.$vars)->json();
                }
            }
        }
       
        return redirect('/devices/unposted')->with('message', 'Device Published successfully.');
    }

    public function publish_device_all(Request $request)
    {
        
        $price = $request->param . ' ' . $request->price;
        
        $data = array('USERID'=>session()->get('user'));
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $data['devices'] = Http::post($url.'UnpostedDevices?'.$vars)->json();
       
        $devices = array();
        if(isset($data['devices']['Data']))
        {
            $devices = $data['devices']['Data']; 
            $serials = explode(',', $request->serial);
            for ($i=0; $i < count($devices); $i++) { 
                $data = array(
                    'UserID'=>session()->get('user'),'UDID'=>$devices[$i]['Imei'],'ModelNo'=>$devices[$i]['ModelNo'],'ModelName'=>$devices[$i]['ModelName'],
                    'Color'=>$devices[$i]['Color'],'Memory'=>$devices[$i]['Memory'],'Carrier'=>$devices[$i]['Carrier'],'FMI'=>$devices[$i]['Fmi'],
                    'Serial'=>$devices[$i]['Serial'],'IMEI'=>$devices[$i]['Imei'],'Firmware'=>$devices[$i]['Firmware'],
                    'Version'=>$devices[$i]['Version'],'OS'=>$devices[$i]['Os'],'Fail'=>$devices[$i]['Fail'],'Pass'=>$devices[$i]['Pass'],
                    'Wipe'=>$devices[$i]['Wipe'],'JailBreak'=>$devices[$i]['Jailbreak'],'ESN'=>$devices[$i]['ESN'],
                    'ANumber'=>$devices[$i]['ANumber'],'RegionCode'=>$devices[$i]['Regioncode'],
                    'Manufacturer'=>$devices[$i]['Manufacturer'],'BatteryModel'=>$devices[$i]['Batterymodel'],
                    'DesignCapacity'=>$devices[$i]['Designcapacity'],'Comments'=>$devices[$i]['Comments'],'CurrentCapacity'=>$devices[$i]['Currentcapacity'],
                    'BatteryHealth'=>$devices[$i]['Batteryhealth'],'CycleCount'=>$devices[$i]['Cyclecount'],
                    'Temperature'=>$devices[$i]['Temperature'],'TransactionNo'=>$devices[$i]['Transactionno'],
                    'CustomerName'=>$devices[$i]['CustomerName'],'InvoiceNo'=>$devices[$i]['InvoiceNo'],'TesterName'=>$devices[$i]['TesterName'],
                    'SimLock'=>$devices[$i]['SimLock'],'isLatest'=>$devices[$i]['IsLatest'],'Time'=>$devices[$i]['Time'],
                    'Price'=>$price,'Status'=>1);
                $url = Config::get('app.API_URL');
                $vars = http_build_query($data);
                $result = Http::post($url.'RegisterMarketPlaceDevice?'.$vars)->json();
            }
        }
        return redirect('/devices/unposted')->with('message', 'Device Published successfully.');
    }

    public function publish_all(Request $request)
    {
        $price = $request->param . ' ' . $request->price;
        $data = array('USERID'=>session()->get('user'));
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $data['devices'] = Http::post($url.'UnpostedDevices?'.$vars)->json();
        $devices = array();
        if(isset($data['devices']['Data']))
        {
            $devices = $data['devices']['Data']; 
            $serials = explode(',', $request->serial);
            for ($i=0; $i < count($devices); $i++) { 
                if (in_array($devices[$i]['Serial'], $serials)) {
                    $data = array(
                        'UserID'=>session()->get('user'),'UDID'=>$devices[$i]['Imei'],'ModelNo'=>$devices[$i]['ModelNo'],'ModelName'=>$devices[$i]['ModelName'],
                        'Color'=>$devices[$i]['Color'],'Memory'=>$devices[$i]['Memory'],'Carrier'=>$devices[$i]['Carrier'],'FMI'=>$devices[$i]['Fmi'],
                        'Serial'=>$devices[$i]['Serial'],'IMEI'=>$devices[$i]['Imei'],'Firmware'=>$devices[$i]['Firmware'],
                        'Version'=>$devices[$i]['Version'],'OS'=>$devices[$i]['Os'],'Fail'=>$devices[$i]['Fail'],'Pass'=>$devices[$i]['Pass'],
                        'Wipe'=>$devices[$i]['Wipe'],'JailBreak'=>$devices[$i]['Jailbreak'],'ESN'=>$devices[$i]['ESN'],
                        'ANumber'=>$devices[$i]['ANumber'],'RegionCode'=>$devices[$i]['Regioncode'],
                        'Manufacturer'=>$devices[$i]['Manufacturer'],'BatteryModel'=>$devices[$i]['Batterymodel'],
                        'DesignCapacity'=>$devices[$i]['Designcapacity'],'Comments'=>$devices[$i]['Comments'],'CurrentCapacity'=>$devices[$i]['Currentcapacity'],
                        'BatteryHealth'=>$devices[$i]['Batteryhealth'],'CycleCount'=>$devices[$i]['Cyclecount'],
                        'Temperature'=>$devices[$i]['Temperature'],'TransactionNo'=>$devices[$i]['Transactionno'],
                        'CustomerName'=>$devices[$i]['CustomerName'],'InvoiceNo'=>$devices[$i]['InvoiceNo'],'TesterName'=>$devices[$i]['TesterName'],
                        'SimLock'=>$devices[$i]['SimLock'],'isLatest'=>$devices[$i]['IsLatest'],'Time'=>$devices[$i]['Time'],
                        'Price'=>$price,'Status'=>1);
                    $url = Config::get('app.API_URL');
                    $vars = http_build_query($data);
                    $result = Http::post($url.'RegisterMarketPlaceDevice?'.$vars)->json();
                }
            }
        }
       return redirect('/devices/unposted')->with('message', 'Device Published successfully.');
    }

    public function edit_price($serial)
    {
        $data = array('Serial'=>$serial);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'SearchSerial?'.$vars)->json();
        $data['device'] = array();
        if (!is_null($response) && !empty($response) && !empty($response['Data']) && isset($response['Data'][0]) && is_array($response['Data'][0])) {
            $data['device'] = $response['Data'][0];
        }
       
        return view('frontend.devices.edit-price', compact('data'));
    }

    public function editPrice(Request $request)
    {
        
        $data = array('Serial'=>$request->serial);
        $url = Config::get('app.API_URL');
        $vars = http_build_query($data);
        $response = Http::post($url.'SearchSerial?'.$vars)->json();
        $data['device'] = array();
        if (!is_null($response) && !empty($response) && !empty($response['Data']) && isset($response['Data'][0]) && is_array($response['Data'][0])) {
            $data['device'] = $response['Data'][0];
        }

        $price = $request->param . ' ' . $request->price;
       
        $data = array(
                        'UserID'=>session()->get('user'),'UDID'=>$data['device']['Imei'],'ModelNo'=>$data['device']['ModelNo'],'ModelName'=>$data['device']['ModelName'],
                        'Color'=>$data['device']['Color'],'Memory'=>$data['device']['Memory'],'Carrier'=>$data['device']['Carrier'],'FMI'=>$data['device']['Fmi'],
                        'Serial'=>$data['device']['Serial'],'IMEI'=>$data['device']['Imei'],'Firmware'=>$data['device']['Firmware'],
                        'Version'=>$data['device']['Version'],'OS'=>$data['device']['Os'],'Fail'=>$data['device']['Fail'],'Pass'=>$data['device']['Pass'],
                        'Wipe'=>$data['device']['Wipe'],'JailBreak'=>$data['device']['Jailbreak'],'ESN'=>$data['device']['ESN'],
                        'ANumber'=>$data['device']['ANumber'],'RegionCode'=>$data['device']['Regioncode'],
                        'Manufacturer'=>$data['device']['Manufacturer'],'BatteryModel'=>$data['device']['Batterymodel'],
                        'DesignCapacity'=>$data['device']['Designcapacity'],'Comments'=>$data['device']['Comments'],'CurrentCapacity'=>$data['device']['Currentcapacity'],
                        'BatteryHealth'=>$data['device']['Batteryhealth'],'CycleCount'=>$data['device']['Cyclecount'],
                        'Temperature'=>$data['device']['Temperature'],'TransactionNo'=>$data['device']['Transactionno'],
                        'CustomerName'=>$data['device']['CustomerName'],'InvoiceNo'=>$data['device']['InvoiceNo'],'TesterName'=>$data['device']['TesterName'],
                        'SimLock'=>$data['device']['SimLock'],'isLatest'=>$data['device']['IsLatest'],'Time'=>$data['device']['Time'],
                        'Price'=>$price,'Status'=>1);
        
        $vars = http_build_query($data);
       
        $result = Http::post($url.'RegisterMarketPlaceDevice?'.$vars)->json();
       
        return redirect('/devices/posted')->with('message', 'Price edit successfully.');
       
        
    }


}
