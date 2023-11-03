@extends('frontend.master')
@section('title')
<title>  Buyer Login | DrFones Market Place</title>
@endsection
@section('styles')
<style>
    ol,
    ul {
        list-style: disc;
    }
    .color-7878df
    {
        color: #7878df;
    }
    .d-flex
    {
        display:flex;
        justify-content: center;
    }
    .mr-5{
        margin-right: 5px;
    }
    .mt-30{
        margin-top:30px !important;
    }

    @media (max-width: 575.98px) {
        .d-flex
        {
        display:flex;
        align-items: center;
        flex-direction: column;
        }
    }
</style>
@endsection
@section('content')
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div
                            class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3 class="mb-30">Login</h3>
                                </div>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                    @php
                                    Session::forget('error');
                                    @endphp
                                </div>
                                @endif

                                <form action="{{ url('buyer/login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" required="" placeholder="Username"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" required="" placeholder="Password"
                                            autocomplete="off">
                                    </div>
                                    {{-- <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="exampleCheckbox1" value="">
                                                <label class="form-check-label" for="exampleCheckbox1"><span>Remember
                                                        me</span></label>
                                            </div>
                                        </div>
                                        <a class="text-muted" href="#">Forgot password?</a>
                                    </div> --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                            name="login">Sign In</button>
                                    </div>
                                    <div class="d-flex mt-30">
                                        <p class="mr-5 ">Don't have an account yet?</p>
                                        <a href="{{ url('buyer/registration') }}" class="color-7878df"> Sign Up!</a>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script-bottom')
@endsection