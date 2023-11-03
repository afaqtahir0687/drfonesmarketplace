@extends('frontend.master')
@section('title')
<title>DrFones Market Place</title>
@endsection
@section('content')
<section class="banner-2 pb-0">
    <div class="banner-img banner-big wow fadeIn animated f-none">
        <img src="{{ asset('frontend/assets/imgs/banner/banner.png')}}" alt="">
    </div>
</section>
<section class="featured section-padding">
    <div class="container">
        @foreach ($models as $key => $value)
        <section class="popular-categories section-padding mt-5">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>{{ $value['CompanyName'] ?? '' }}</span> Store</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-{{ $key ?? '' }}-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns-{{ $key ?? '' }}">
                        @foreach ($value['items'] as $model)
                            <div class="p-10">
                                <a href="{{ url('q') }}/{{ str_replace(' ','-',strtolower($model['ModelName'])) }}?id={{ $key ?? '' }}">
                                    <div class="banner-features wow fadeIn animated hover-up animated">
                                        <img src="{{ asset('models')}}/{{  (strpos($model['ModelName'],'iPhone') !== false)?$model['ModelName']:'Android' }}.jpg" style="width: 50%;" alt="">
                                        <h4 class="bg-3 ">{{ $model['ModelName'] ?? '' }} ({{ $model['Count'] ?? '' }})</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endforeach
    </div>
</section>
<section class="featured section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 deal-co">
                <div class="deal wow fadeIn animated mb-md-4 mb-sm-4 mb-lg-0 animated animated">
                    <div class="deal-top">
                        <img src="{{ asset('frontend/assets/imgs/genuine-buyer.jpg') }}">
                        <h2 class="text-brand">Genuine Buyers</h2>
                    </div>
                    <div class="deal-content">
                        Get authentic offers from verified buyers
                    </div>
                </div>
            </div>
            <div class="col-lg-6 deal-co">
                <div class="deal wow fadeIn animated animated animated" >
                    <div class="deal-top">
                        <img src="{{ asset('frontend/assets/imgs/sell-faster.jpg') }}">
                        <h2 class="text-brand">Sell Faster</h2>
                    </div>
                    <div class="deal-content">
                        Sell your Mobiles faster than other at a better prize.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding">
    <div class="container pb-20">
        <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
        <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
            <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows">
            </div>
            <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                <!-- <div class="brand-logo">
                    <img class="img-grey-hover" src="{{ asset('brands/img-1.png')}}" alt="">
                </div> -->
                <!-- <div class="brand-logo">
                    <img class="img-grey-hover" src="{{ asset('brands/img-2.png')}}" alt="">
                </div> -->
                <div class="brand-logo">
                    <img class="img-grey-hover" src="{{ asset('brands/img-3.png')}}" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="{{ asset('brands/img-4.png')}}" alt="">
                </div>

                <div class="brand-logo">
                    <img class="img-grey-hover" src="{{ asset('brands/img-6.png')}}" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="{{ asset('brands/img-7.png')}}" alt="">
                </div>
                <!-- <div class="brand-logo">
                    <img class="img-grey-hover  mt-25" src="{{ asset('brands/img-8.png')}}" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover mt-15" src="{{ asset('brands/img-9.png')}}" alt="">
                </div> -->
                <div class="brand-logo">
                    <img class="img-grey-hover mt-15" src="{{ asset('brands/img-10.jpg')}}" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover mt-15" src="{{ asset('brands/img-11.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script-bottom')
@endsection
