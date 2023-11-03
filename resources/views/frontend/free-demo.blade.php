@extends('frontend.master')
@section('title')
<title>Free Demo | DrFones Market Place</title>
@endsection
@section('styles')
<style>
    .ml-12{
        margin-left:12px !important;
    }
    .mb-20{
        margin-bottom:20px;
    }
    #demoForm
    {
        background: linear-gradient(28deg, rgba(186,226,253,1) 0%, rgba(30,181,236,1) 100%);
    }
    h3,h4,label,span
    {
        color:#fff !important;
    }

    label,span
    {
        font-size: 14px;
    }
    .color-077b9f
    {
        color: #077b9f !important;
    }
    .font-16{
        font-size:16px;
    }
    .font-weight-bold
    {
        font-weight: bold;
    }
</style>
@endsection
@section('content')

<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ url('submit-demo-requestion') }}" method="POST" class="login_wrap widget-taber-content p-30 background-white border-radius-10" id="demoForm">
                        @csrf
                        <div class="heading_s1 mt-1 p-20">
                            <h3 class="mb-20 text-center">Free Demo</h3>
                            <h4 class="text-center">Request a free demo of DrFones</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-4">
                                <!--begin::Input-->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control form-control-solid form-control-lg" required name="name" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control form-control-solid form-control-lg" required name="phone" placeholder="Enter your Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-4">
                                    <!--end::Input-->
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control form-control-solid form-control-lg" name="email" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <!--end::Input-->
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control form-control-solid form-control-lg" required name="company_name" placeholder="Enter Company">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-4">
                                    <!--end::Input-->
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control form-control-solid form-control-lg" required name="country" placeholder="Enter Country">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <!--end::Input-->
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>How many Device you test Daily?</label>
                                        <input type="text" class="form-control form-control-solid form-control-lg" required name="devices" placeholder="How many Device you test Daily?">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <!--begin::Input-->
                                    <div class="form-floting mb-6">
                                        <textarea class="form-control form-control-solid form-control-lg mb-20" placeholder="Are you already using a device software?" style="height:150px" id="exampleTextarea" required name="testing_software"></textarea>
                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <span class="form-text text-center color-077b9f font-weight-bold font-16">Like you, we hate spam, so we promise to send you only
                                        communications related to DrFones </span>
                                </div>
                            </div> -->
                        </div>
                        <!--begin::Actions-->
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-xl-4 mt-3">
                                    <div>
                                        <button type="submit" class="btn btn-primary font-weight-bold ml-12">Submit</button>
                                    </div>
                                </div>
                                <div class="col-xl-3"></div>
                            </div>
                        
                        <!--end::Actions-->
                    </form>
                </div>

        </div>
    </div>
</section>
@endsection
@section('script-bottom')
@endsection