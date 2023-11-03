@extends('frontend.master')
@section('title')
<title>Testmonials | DrFones Market Place</title>
@endsection
@section('styles')
@endsection

@section('content')

    <style>
        .user-content p {
            margin-top: 5px;
            font-size: 12px;
        }

        .ratings i {
            color: #FFA800;
        }
        .card-custom {
            height: calc(100% - 28px);
            margin-bottom: 50px;
            font-size: 15px;

        }
        .user-content p {
            font-size: 15px;
        }
    </style>
</head>



<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <form class="form" action="{{ url('testimonials') }}" method="POST">

            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Heading-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h2 class="text-white font-weight-bold my-2 mr-5">Testimonials</h2>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
            </div>
            <!--end::Info-->
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container mb-5">
        <div class="row text-center">


            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch" >
                    <!--begin::Body-->

                    <div class="card-body pb-5 mydivouter">
                        <div class="user-image mb-2">
                            <img src="https://drfonesmarketplace.com/public/frontend/assets/imgs/logo/logo.png" width="100">
                        </div>
                        <div class="user-content">
                            <span></span>
                            <p>We can process large volumes of devices with a high level of reliability. All on a printable label with a full diagnostic report. And all the data extracted from each device remains in our dashboard.
                            </p>
                        </div>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-body pb-5 mydivouter">
                        <div class="user-image mb-2">
                            <img src="https://drfonesmarketplace.com/public/frontend/assets/imgs/logo/logo.png" width="100">
                        </div>
                        <div class="user-content">
                            <span></span>
                            <p>
                                In these several years of activity we have tried many diagnostic software applications for our devices, without ever being fully satisfied. Ever since entrusting our diagnostic needs to the DrFones team, the quality has increased, and the time required for diagnostics has dropped dramatically. We finally found the partner we were looking for.
                            </p>
                        </div>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-body pb-5 mydivouter">
                        <div class="user-image mb-2">
                            <img src="https://drfonesmarketplace.com/public/frontend/assets/imgs/logo/logo.png" width="100">
                        </div>
                        <div class="user-content">
                            <span></span>
                            <p>
                                Our business depends on our customers’ satisfaction, and since we have been working with DRFONES the number of returns has drastically decreased and our turnover has increased. Our customers are happy and we’re happy.
                            </p>
                        </div>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mt-3">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-body pb-5 mydivouter">
                        <div class="user-image mb-2">
                            <img src="https://drfonesmarketplace.com/public/frontend/assets/imgs/logo/logo.png" width="100">
                        </div>
                        <div class="user-content">
                            <span></span>
                            <p>
                                DRFONES allows us to process faster, test accurately and collect all the information needed to keep track of incoming and outgoing inventory.
                            </p>
                        </div>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mt-3">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-body pb-5 mydivouter">
                        <div class="user-image mb-2">
                            <img src="https://drfonesmarketplace.com/public/frontend/assets/imgs/logo/logo.png" width="100">
                        </div>
                        <div class="user-content">
                            <span></span>
                            <p>
                                DRFONES provides us with a solution for each step of processing: from triage to labels, reporting and analytics - all my bases are covered.
                            </p>
                        </div>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-body pb-5 mydivouter">
                        <div class="user-image mb-2">
                            <img src="https://drfonesmarketplace.com/public/frontend/assets/imgs/logo/logo.png" width="100">
                        </div>
                        <div class="user-content">
                            <span></span>
                            <p>
                                DRFONES is the best diagnostic tool on the market. Our testers have an advantage which enables them to prioritize accuracy.
                            </p>
                        </div>
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-bottom')
@endsection