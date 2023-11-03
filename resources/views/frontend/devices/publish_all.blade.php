@extends('frontend.master')
<title>Unposted Devices | DrFones Market Place</title>
@section('styles')
@endsection
@section('content')
@php
use Carbon\Carbon;
@endphp
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="{{ isset($serial)? url('devices/publish/all') : url('devices/publish/all/devices') }}" method="POST" enctype="multipart/form-data" class="login_wrap widget-taber-content p-30 background-white border-radius-10" >
                    @csrf

                    <div class="heading_s1">
                        <h3 class="mb-30">Publish Device</h3>
                    </div>
                    @if(isset($serial) && !empty($serial))
                        <input type="hidden" name="serial" value="{{ $serial }}">
                    @endif
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Add Currency</label>
                        <select class="form-control select2" id="kt_select2_1" name="param" style="width: 100%;">
                            <option value="$">$</option>
                            {{-- <option value="AED">AED</option>
                            <option value="£">£</option>
                            <option value="Rs.">Rs.</option>
                            <option value="¥">¥</option>
                            <option value="CN¥">CN¥</option>
                            <option value="HK$">HK$</option>
                            <option value="C$">C$</option>
                            <option value="€">€</option> --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Add Price</label>
                        <input type="text" id="add_price" name="price" class="form-control" required>
                    </div>
                    

                    <button type="submit" class="btn btn-primary">Publish</button>

                </form>

            </div>
        </div>
    </div>
</section>
@endsection
@section('script-bottom')
@endsection