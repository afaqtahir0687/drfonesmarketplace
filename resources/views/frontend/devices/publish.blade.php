@extends('frontend.master')
@section('title')
<title>Unposted Devices | DrFones Market Place</title>
@endsection
@section('styles')
@endsection
@section('content')
@php
use Carbon\Carbon;
@endphp
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ url('devices/published') }}" method="POST" class="login_wrap widget-taber-content p-30 background-white border-radius-10" enctype="multipart/form-data">
                    @csrf
                    <div class="heading_s1">
                        <h3 class="mb-30">Publish Device (Serial : {{ $serial ?? '' }})</h3>
                    </div>
                    <input type="hidden" name="serial" value="{{ $serial ?? '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Currency</label>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Add Price</label>
                                <input type="text" id="add_price" name="price" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Feature Image</label>
                                <input type="file" name="feature_image" class="form-control file-input" accept="image/png" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Images (Up to 3)</label>
                                <input type="file" name="images[]" class="form-control file-input" accept="image/png" multiple>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" >Publish</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script-bottom')
@endsection