@extends('frontend.master')
<title>Publish Devices | DrFones Market Place</title>
@section('styles')
<style>
   .badge-primary
   {
    background-color: #4949db;
   }
   .float-right
    {
    float: right;
    }
</style>
@endsection
@section('content')
@php
use Carbon\Carbon;
@endphp
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary publish" id="publish-selected"
                        style="padding: 8px 10px;margin-right:10px;">Mark Sold <span class="badge badge-light">0</span></button>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="section-title style-1 mb-10">Publishes Devices</h3>
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
                            @foreach ($devices as $device)
                            <tr>
                                <td>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input checkbox-single checkboxes" type="checkbox" name="devices[]"
                                            id="{{ $device['Serial'] ?? '' }}" value="{{ $device['Serial'] ?? '' }}">
                                        <label class="form-check-label" for="{{ $device['Serial'] ?? '' }}"><span></span></label>
                                    </div>
                                </td>
                                <td> {{ $device['ModelName'] }} </td>
                                <td>
                                    <p> <strong> Serial :  </strong> {{ $device['Serial'] }}</p>
                                    <p> <strong> IMEI :  </strong> {{ $device['Imei'] }}</p>
                                </td>
                                <td>{{ Carbon::parse($device['Time'])->format('d/m/y') }}, {{ Carbon::parse($device['Time'])->format('H:i:s') }}</td>
                                <td> {{ $device['Color'] }} </td>
                                <td><span class="badge badge-primary">Published</span> </td>
                                <!--{{ url('devices/publish') . '/' . $device['Serial'] }}-->
                                <td><a href="javascript::void(0)" class="btn-success btn-sm sold-btn" data-serial="{{ $device['Serial'] }}"><i class="fi-rs-settings-sliders mr-10"></i> Sold</a>
                                <a href="{{ url('devices/edit-price') . '/' . $device['Serial'] }}" class="btn-success btn-sm edit-price-btn"><i class="fa-dollar-sign mr-10"></i> Edit Price</a> </td>
                            </tr>
                            @endforeach

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
                            <a class="btn-sm btn-primary" href="{{ url('/devices/published') }}?page={{$pre}}"> < Previous Page</a>
                        </li>
                    @endif
                    <li class="page-item ms-3">
                        <a class="btn-sm btn-primary ml-2" href="{{ url('/devices/published') }}?page={{$next}}">Next Page ></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form id="soldForm" action="{{ url("mark-sold") }}" method="POST">
         @csrf
        <input type="hidden" type="text" name="serial" id="deviceSerial">
    </form>
    <form method="POST" id="publish-all" action="{{ url('mark-sold/all') }}">
        @csrf
        @method("POST")
        <input type="hidden" id="serial" name="serial" value="">
    </form>
    
</section>
@endsection
@section('script-bottom')

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

        swal({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        buttons: [
        'Cancel',
        'Mark Sold!'
        ],
        dangerMode: true,
        }).then(function(isConfirm) {
        if (isConfirm) {
            $('#serial').val(array.join(','));
            $('#publish-all').submit();
        } else {
        
        }
        })
        
    })
    });

    $(document).on('click', '.sold-btn', function(){
        let serial = $(this).attr("data-serial")
        $("#deviceSerial").val(serial)

        swal({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        buttons: [
        'Cancel',
        'Mark Sold!'
        ],
        dangerMode: true,
        }).then(function(isConfirm) {
        if (isConfirm) {
          $("#soldForm").submit()
        } else {
        
        }
        })
    })

</script>
@endsection