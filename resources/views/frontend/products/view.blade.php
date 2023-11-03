@extends('frontend.master')
@section('title')
@php
    $name = $device['ModelName'] . ' ' .$device['Color'] . ' ' .$device['Memory'] . ' ' . $device['SimLock'];
@endphp
<title>  {{ $name ?? '' }} | DrFones Market Place</title>
@endsection
@section('styles')
<style>
    span a{
        color:#4646f7 !important;
    }
    button
    {
    background-color: #10b4e5 !important;
    border: 0px !important;
    font-weight: bold !important;
    }
</style>
@endsection
@section('content')
<main class="main">
    <section class="mt-20 mb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12 ">
                                <div class="detail-gallery text-align-webkit">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @forelse(File::glob(public_path('images/'.$device['Serial'] ).'/*') as $path)
                                            <figure class="border-radius-10 ">
                                                <img src="{{ asset('/')}}{{ str_replace(public_path(), '', $path) }}" alt="product image" onerror="this.onerror=null;this.src='{{ asset('models')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?$device['ModelName']:'Android' }}.jpg';">
                                            </figure>
                                        @empty
                                            <figure class="border-radius-10 ">
                                                <img src="{{ asset('models/color')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?strtolower($device['ModelName']):'Android' }} {{ strtolower($device['Color']) }}.jpg" alt="{{ asset('models/color')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?strtolower($device['ModelName']):'Android' }} {{ strtolower($device['Color']) }}.jpg" onerror="this.onerror=null;this.src='{{ asset('models')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?$device['ModelName']:'Android' }}.jpg';">
                                            </figure>
                                        @endforelse
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @forelse(File::glob(public_path('images/'.$device['Serial']).'/*') as $path)
                                            <div><img src="{{ asset('/')}}{{ str_replace(public_path(), '', $path) }}" onerror="this.onerror=null;this.src='{{ asset('models')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?$device['ModelName']:'Android' }}.jpg';" alt="product image"></div>
                                        @empty
                                            <div><img src="{{ asset('models/color')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?strtolower($device['ModelName']):'Android' }} {{ strtolower($device['Color']) }}.jpg" onerror="this.onerror=null;this.src='{{ asset('models')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?$device['ModelName']:'Android' }}.jpg';" alt="{{ asset('models/color')}}/{{  (strpos($device['ModelName'],'iPhone') !== false)?strtolower($device['ModelName']):'Android' }} {{ strtolower($device['Color']) }}.jpg"></div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{ isset($name) ? str_replace('GBGB', 'GB', $name): '' }}</h2>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="product-detail-rating">
                                                <div class="product-rate-cover text-end">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:{{ $avg_percentage }}%">
                                                        </div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> ({{ $comments->count() }} reviews)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand">Price : {{ str_replace ('$$','$','$'.str_replace(' ','',$device['Price'])) }}</span></ins>
                                        </div>
                                        <div class=""></div>
                                        <div class=""></div>
                                        <div class=""></div>
                                        <div class=""></div>
                                        <div class=""></div>
                                        <div class="get-report">
                                            <a  aria-label="Get Report" class="action-btn hover-up font-xl pull-right" target="_blank" href="https://drfonescloud.com/cloud-lookup-qr?IMEI={{ $device['Serial'] ?? '' }}&USERID={{ $device['UserID'] }}"><i class="fi-rs-file"></i></a>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-10">
                                        <div class="table-responsive">
                                            <table class="font-md mb-5">
                                                <tbody>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Model</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['ModelName'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Model No</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['ModelNo'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Serial</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Serial'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">IMEI</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Imei'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                     <tr class="stand-up">
                                                        <th class="p-1 ps-3">Carrier</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Carrier'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                     <tr class="stand-up">
                                                        <th class="p-1 ps-3">Firmware</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Firmware'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Version</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Version'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">SimLock</th>
                                                        <td class="p-1 ps-3">
                                                            <p><span class="{{ $device['SimLock'] == "Block" ? 'text-danger': '' }}">{{ $device['SimLock'] ?? '' }}</span></p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">ESN</th>
                                                        <td class="p-1 ps-3">
                                                            <p><span class="{{ $device['ESN'] != "Clean" ? 'text-danger': '' }}">{{ $device['ESN'] ?? '' }}</span></p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Fmi</th>
                                                        <td class="p-1 ps-3">
                                                            <p><span class="{{ $device['Fmi'] == "On" ? 'text-danger': '' }}">{{ $device['Fmi'] ?? '' }}</span></p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Color</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Color'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">ANumber</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['ANumber'] ?? ''  }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Jailbreak</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Jailbreak'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Regioncode</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Regioncode'] ?? '' }}</p>
                                                        </td>

                                                    </tr>

                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Date</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ \Carbon\Carbon::parse($device['Time'])->format('d/m/Y') ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Condition</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Condition'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                    <tr class="stand-up">
                                                        <th class="p-1 ps-3">Description</th>
                                                        <td class="p-1 ps-3">
                                                            <p>{{ $device['Description'] ?? '' }}</p>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- <div class="product_sort_info font-xs mb-10">
                                        <ul>
                                            <li><i class="fi-rs-credit-card mr-5"></i> {{ $device['Time'] ?? '' }} </li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="attr-detail attr-color mb-5">
                                        <strong class="mr-10">Color</strong>
                                        <ul class="list-filter color-filter">
                                            <li><a href="#" data-color="{{ $device['Color'] ?? '' }}"><span class="product-color-{{ strtolower($device['Color']) }}"></span></a></li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="bt-1 border-color-1 mt-10 mb-10"></div>
                                    <div class="detail-extralink">

                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart">Add to cart</button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-10">
                                        <li class="mb-2">ANumber: <a href="#">{{ $device['ANumber'] ?? '' }}</a></li>
                                        <li class="mb-2">Jailbreak: <a href="#" rel="tag">{{ $device['Jailbreak'] ?? '' }}</a></li>
                                        <li>Regioncode:<span class="in-stock text-success ml-5">{{ $device['Regioncode'] ?? '' }}</span></li>
                                    </ul> -->
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 m-auto entry-main-content">
                                <h3 class="section-title style-1 mb-10">Battery info</h3>
                                <div class="font-md mb-20">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>Battery Model</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-success ml-5">{{ $device['Batterymodel'] ?? 'N/A' }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>Cycle Count</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-success ml-5">{{ $device['Cyclecount'] ?? 'N/A' }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>Battery Health</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-success ml-5">{{ $device['Batteryhealth'] ?? 'N/A' }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>Design Capacity</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-success ml-5">{{ $device['Designcapacity'] ?? 'N/A' }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>Current Capacity</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-success ml-5">{{ $device['Currentcapacity'] ?? 'N/A' }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>Temperature</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-success ml-5">{{ $device['Temperature'] ?? 'N/A' }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="section-title style-1 mb-10">Pass Tests</h3>
                                @php
                                    $pass = array();
                                    if(!empty($device['Pass']))
                                    {
                                        $pass = explode(',',$device['Pass']);
                                    }
                                @endphp
                                <div class="font-md mb-20">
                                    <div class="row">
                                        @if(count($pass) > 0)
                                            @for($i=0; $i < count($pass); $i++)
                                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                                    <div class="p-1 ps-3 borderd-pdp">
                                                        <strong>{{ $pass[$i] ?? '' }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                                    <div class="p-1 ps-3 borderd-pdp">
                                                        <p> <span class="in-stock text-success ml-5">Pass</span></p>
                                                    </div>
                                                </div>
                                            @endfor
                                        @else
                                            <div class="col-md-12 col-sm-12 col-xs-12 ps-0 mt-1">
                                                <div class="p-1 ps-3 borderd-pdp">
                                                    <p> <span class="in-stock text-Warning ml-5">Empty</span></p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <h3 class="section-title style-1 mb-10">Fail Tests</h3>
                                @php
                                    $fail = array();
                                    if(!empty($device['Fail']))
                                    {
                                        $fail = explode(',',$device['Fail']);
                                    }
                                @endphp
                                <div class="font-md mb-20">
                                    <div class="row">
                                        @if(count($fail) > 0)
                                            @for($i=0; $i < count($fail); $i++)
                                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                                    <div class="p-1 ps-3 borderd-pdp">
                                                        <strong>{{ $fail[$i] ?? '' }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                                    <div class="p-1 ps-3 borderd-pdp">
                                                        <p> <span class="in-stock text-danger ml-5">Fail</span></p>
                                                    </div>
                                                </div>
                                            @endfor
                                        @else
                                            <div class="col-md-12 col-sm-12 col-xs-12 ps-0 mt-1">
                                                <div class="p-1 ps-3 borderd-pdp">
                                                    <p> <span class="in-stock text-Warning ml-5">Empty</span></p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <h3 class="section-title style-1 mb-30 mt-30">Reviews (<span id="reviewCount">{{ $comments->count() }}</span>)</h3>
                                <!--Comments-->
                                <div class="comments-area style-2">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions & answers</h4>
                                            <div class="comment-list">
                                                @php
                                                use Carbon\Carbon;
                                                @endphp
                                                @foreach($comments as $comment)
                                                <div class="single-comment">
                                                    <div class="user">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="thumb text-center">
                                                                    <img src="assets/imgs/page/avatar-6.jpg" alt="">
                                                                    <h6><a href="#">{{ $comment->name }}</a></h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="desc">
                                                                    <div class="product-rate d-inline-block">
                                                                        @php
                                                                        switch ($comment->rating) {
                                                                        case 1:
                                                                            $style = "width:20%";
                                                                            break;
                                                                        case 2:
                                                                            $style = "width:40%";
                                                                            break;
                                                                        case 3:
                                                                            $style = "width:60%";
                                                                            break;
                                                                        case 4:
                                                                            $style = "width:80%";
                                                                            break;

                                                                        default:
                                                                            $style = "width:100%";
                                                                        }
                                                                        @endphp
                                                                        <div class="product-rating" style = "{{ $style }}">
                                                                        </div>
                                                                    </div>
                                                                    <p>{{ $comment->comments }}</p>
                                                                    

                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="font-xs mr-30">{{ Carbon::parse($comment->created_at)->format('F d,  Y') }} at {{ Carbon::parse($comment->created_at)->format('g:i A') }} </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                @php
                                                                        $userData = request()->session()->get('user_data');
                                                                    @endphp

                                                                    @if(isset($userData['ID']) && $userData['ID'] == $comment->user_id)
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <span><a href="javascript:void(0)" class="editReviewButton" data-reveiw_id="{{  $comment->id }}">Edit</a>|<a href="{{ url("/delete-review", $comment->id) }}" class="ml-2">Delete</a></span>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-lg-4" id="customerReview">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
                                                <div class="product-rate d-inline-block mr-15">
                                                    <div class="product-rating" style="width:{{ $avg_percentage }}%">
                                                    </div>
                                                </div>
                                                <h6>{{ $avg_ratings }} out of 5</h6>
                                            </div>
                                            @php
                                            $five_star_per = 0;
                                            $four_star_per = 0;
                                            $three_star_per = 0;
                                            $two_star_per = 0;
                                            $one_star_per = 0;
                                            $total = $comments->count();
                                            $five_star_total = $comments->where('rating', 5)->count();
                                            if($total != 0)
                                            {

                                                $five_star_total = $comments->where('rating', 5)->count();
                                                $five_star_per = round($five_star_total / $total * 100);

                                                $four_star_total = $comments->where('rating', 4)->count();
                                                $four_star_per = round($four_star_total / $total * 100);

                                                $three_star_total = $comments->where('rating', 3)->count();
                                                $three_star_per = round($three_star_total / $total * 100);

                                                $two_star_total = $comments->where('rating', 2)->count();
                                                $two_star_per = round($two_star_total / $total * 100);

                                                $one_star_total = $comments->where('rating', 1)->count();
                                                $one_star_per = round($one_star_total / $total * 100);
                                            }
                                            @endphp
                                            <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: {{ $five_star_per }}%;" aria-valuenow="{{ $five_star_per }}" aria-valuemin="0" aria-valuemax="100">{{ $five_star_per }}%</div>
                                            </div>
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: {{ $four_star_per }}%;" aria-valuenow="{{ $four_star_per }}" aria-valuemin="0" aria-valuemax="100">{{ $four_star_per }}%</div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: {{ $three_star_per }}%;" aria-valuenow="{{ $three_star_per }}" aria-valuemin="0" aria-valuemax="100">{{ $three_star_per }}%</div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: {{ $two_star_per }}%;" aria-valuenow="{{ $two_star_per }}" aria-valuemin="0" aria-valuemax="100">{{ $two_star_per }}%</div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: {{ $one_star_per }}%;" aria-valuenow="{{ $one_star_per }}" aria-valuemin="0" aria-valuemax="100">{{ $one_star_per }}%</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @if(!is_null(session()->get('user'))  && session()->get('buyer_login') == 1)
                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>
                                    <div class="clear-both">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form  class="form-contact comment_form" action="{{ route('review.store') }}" method="POST" id="commentForm">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="rate add-rating-stars">
                                                                <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio"  id="star4" class="rate" name="rating" value="4"/>
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" checked id="star1" class="rate" name="rating" value="1"/>
                                                                <label for="star1" title="text">1 star</label>
                                                            </div>
                                                            <input type="hidden" name="parent_id" value="0">
                                                            <input type="hidden" name="mode" value="add">
                                                            <input type="hidden" name="imei" value="{{ $device['Imei'] }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" required name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" required id="name" type="text" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="contact_no" required id="" type="text" placeholder="Contact No">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="alert alert-success" role="alert" style="display:none">
                                                        Your Comments published Successfully !
                                                    </div>
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- Modal -->
<div class="modal fade" id="reviewEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Review</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="modalbody">

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@section('script-bottom')
<script>
// this is the id of the form
$("#commentForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            $('#commentForm')[0].reset();
            $(".alert-success").show().delay(1000).fadeOut();
            $("#reviewCount").html(data.total)
            $(".comment-list").html(data.html)
            $("#customerReview").html(data.customer_review_html)
        }
    });

});


$(document).on('click', '.editReviewButton', function() {
    let id = $(this).attr('data-reveiw_id')
    $.ajax({
    type: "GET",
    url: '/get-review-detail',
    data: {id:id}, // serializes the form's elements.
    success: function(data)
    {
    $("#modalbody").html(data.html)
    $(".add-rating-stars").remove()
    $("#reviewEditModal").modal("show")
    }
    });
});

$(".close-modal").on("click", function(){
    $(".add-rating-stars").show()
    $("#reviewEditModal").modal("hide")
})
</script>
@endsection
