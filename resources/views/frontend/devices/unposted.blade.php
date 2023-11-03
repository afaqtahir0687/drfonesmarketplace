@extends('frontend.master')
<title>Unposted Devices | DrFones Market Place</title>
@section('styles')
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<style>
    .float-right
    {
        float: right;
    }
    .btn .badge {
    position: relative;
    top: -1px;
    }
    .badge-light {
    color: #212529;
    background-color: #f8f9fa;
    }
    .badge {
    display: inline-block;
    padding: .25em .4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
    }
</style>
@endsection
@section('content')
@php
    use Carbon\Carbon;
@endphp
<section class="mt-20 mb-20">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="sidebar-widget widget_search mb-10">
                    <div class="search-form">
                        <form action="{{ url('devices/unposted') }}" method="GET">
                            <input type="text" name="IMEI" placeholder="Search IMEI" value="{{ request()->IMEI ?? '' }}">
                            <button type="submit" class="search--btn"> <i class="fi-rs-search"></i> </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <form action="{{ url('devices/unposted') }}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="from" placeholder="From Date" id="datepicker-12" value="{{ request()->from ?? '' }}">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="to" placeholder="To Date" id="datepicker-13" value="{{ request()->to ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn filter--btn"><i class="fi-rs-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary publish"  id="publish-selected" style="padding: 8px 10px;margin-right:10px;">Publish <span class="badge badge-light">0</span></button>
                    <a href="{{ url('devices/publish/all') }}" type="submit" class="btn btn-primary" id="publish-selected" style="padding: 8px 10px;">Publish All</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="section-title style-1 mb-10">Unposted Devices</h3>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="main-heading">
                                <th>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input check-all" type="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"><span></span></label>
                                    </div>
                                </th>
                                <th scope="col">Model Name</th>
                                <th scope="col">Serial</th>
                                <th scope="col">Time</th>
                                <th scope="col">Color</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($devices))
                                @foreach ($devices as $device)                        
                                <tr>
                                    <td>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input checkbox-single checkboxes" type="checkbox" name="devices[]" id="{{ $device['Serial'] ?? '' }}" value="{{ $device['Serial'] ?? '' }}">
                                            <label class="form-check-label" for="{{ $device['Serial'] ?? '' }}"><span></span></label>
                                        </div>
                                    </td>
                                    <td> {{ $device['ModelName'] }} {{ $device['Color'] ?? '' }} {{ $device['Memory'] ?? '' }} {{ $device['SimLock'] ?? '' }} </td>
                                    <td>
                                        <p> <strong> Serial :  </strong> {{ $device['Serial'] }}</p>
                                        <p> <strong> IMEI :  </strong> {{ $device['Imei'] }}</p>
                                    </td>
                                    <td>{{ Carbon::parse($device['Time'])->format('Y-m-d') }} {{ Carbon::parse($device['Time'])->format('H:i:s') }}</td>
                                    <td > {{ $device['Color'] }} </td>
                                    <td >
                                        <span class="badge badge-primary">{{ $device['Status'] == '' ? 'Pending' : $device['Status'] }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ url('devices/publish') . '/' . $device['Serial'] }}" class="btn-warning btn-sm" title="Publish This Device"><i class="fi-rs-settings-sliders mr-10"></i> Publish</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">
                                        <p>No Data Found</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <ul class="pagination pull-right mt-3">
                    @php
                    $pre = 0; $next = 0;
                    if(request()->page > 0)
                    {
                        $pre = request()->page - 1;
                    }
                    if (!isset(request()->page))
                    {
                        $next = request()->page + 2;
                    }
                    else {
                        $next = request()->page + 1;
                    }
                    @endphp
                    @if ($pre == 0)
                        <li class="page-item">
                            <a class="btn-sm btn-primary disabled"  href="javascript:;"> < Previous Page</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="btn-sm btn-primary" href="{{ url('/devices/unposted') }}?page={{$pre}}"> < Previous Page</a>
                        </li>
                    @endif
                    <li class="page-item ms-3">
                        <a class="btn-sm btn-primary ml-2" href="{{ url('/devices/unposted') }}?page={{$next}}">Next Page ></a>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
    <form id="publishBtn" action="{{ url('devices/publish') }}" method="POST">
        @csrf
        <input type="hidden" type="text" name="serial" id="serial_all">
    </form>
</section>
@endsection
@section('script-bottom')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
        $("input[type='checkbox']").prop("checked", false);
        var array = $.map($('input[name="devices[]"]:checked'), function(c){return c.value; });
        if (array.length > 0) {
        $('#publish-selected').prop('disabled',false)
        }
        else
        {
        $('#publish-selected').prop('disabled',true)
        }

    })

    $(function() {
            $( "#datepicker-12" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker-13" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });

    $(function(){
        
        $('body').on('click','.check-all',function(e){
        if($(this).is(':checked')){
            $('.checkboxes').prop('checked', true);
        } else {
            $('.checkboxes').prop('checked', false);
        }
        var array = $.map($('input[name="devices[]"]:checked'), function(c){return c.value; });
        $('.badge-light').text(array.length);
        if (array.length > 0) {
        $('#publish-selected').prop('disabled',false)
        }
        else
        {
        $('#publish-selected').prop('disabled',true)
        }
        })
    });
    $(function(){
        $('body').on('click','.checkbox-single',function(e){
       
        var array = $.map($('input[name="devices[]"]:checked'), function(c){return c.value; });
        $('.badge-light').text(array.length);
        if (array.length > 0) {
        $('#publish-selected').prop('disabled',false)
        }
        else
        {
        $('#publish-selected').prop('disabled',true)
        }
        })

        $(".publish").click(function(){
            var array = $.map($('input[name="devices[]"]:checked'), function(c){return c.value; });
           
            $('#serial_all').val(array.join(','));
            $('#publishBtn').submit();
        })
    });
</script>
@endsection