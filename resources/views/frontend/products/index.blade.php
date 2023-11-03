@extends('frontend.master')
@section('title')
<title>  Products | DrFones Market Place</title>
@endsection
@section('content')
<main class="main">
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">{{ $total ?? 0 }}</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> {{ request()->limit ?? 15 }} <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a {{ (!isset(request()->limit) || request()->limit == 15)?'class="active"':'' }} href="{{ request()->fullUrlWithQuery(['limit' => 15]) }}">15</a></li>
                                        <li><a {{ (isset(request()->limit) && request()->limit == 30)?'class="active"':'' }} href="{{ request()->fullUrlWithQuery(['limit' => 30]) }}">30</a></li>
                                        <li><a {{ (isset(request()->limit) && request()->limit == 35)?'class="active"':'' }}  href="{{ request()->fullUrlWithQuery(['limit' => 45]) }}">45</a></li>
                                        <li><a {{ (isset(request()->limit) && request()->limit == 100)?'class="active"':'' }} href="{{ request()->fullUrlWithQuery(['limit' => 100]) }}">100</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @forelse ($devices as $item )
                            <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom text-center">
                                            @php
                                                $name = strtolower($item['ModelName'] . ' ' .$item['Color'] . ' ' .$item['Memory'] . ' ' . $item['SimLock']);
                                                $link = str_replace(' ','-',$name);
                                                $link = $link .'?serial='.$item['Serial'];
                                                $link = url($link);
                                                $i = 0;
                                            @endphp
                                            <a href="{{ $link ?? '' }}">
                                                @forelse(File::glob(public_path('images/'.$item['Serial'] ).'/*') as $path)
                                                     @php
                                                        if($i == 1) { break; } $i++;
                                                    @endphp
                                                    <img class="default-img" src="{{ asset('/')}}{{ str_replace(public_path(), '', $path) }}" alt="{{ $item['ModelName'] ?? '' }} {{ $item['Color'] ?? '' }} {{ $item['Memory'] ?? '' }} {{ $item['SimLock'] ?? '' }}" onerror="this.onerror=null;this.src='{{ asset('models')}}/{{  (strpos($item['ModelName'],'iPhone') !== false)?$item['ModelName']:'Android' }}.jpg';">
                                                @empty
                                                    <img  class="default-img" src="{{ asset('models/listing')}}/{{  (strpos($item['ModelName'],'iPhone') !== false)?strtolower($item['ModelName']):'Android' }} {{ strtolower($item['Color']) }}.jpg" onerror="this.onerror=null;this.src='{{ asset('models')}}/{{  (strpos($item['ModelName'],'iPhone') !== false)?$item['ModelName']:'Android' }}.jpg';" alt=" {{ $item['ModelName'] ?? '' }} {{ $item['Color'] ?? '' }} {{ $item['Memory'] ?? '' }} {{ $item['SimLock'] ?? '' }}">
                                                @endforelse
                                            </a>
                                        </div>
                                        <!-- <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                            <i class="fi-rs-search"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div> -->
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Feature</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <!-- <a href=""> <strong>IMEI : </strong> {{ $item['Imei'] ?? '' }}</a> -->
                                            <a href="{{ $link ?? '' }}"> <strong>Serial : </strong> {{ $item['Serial'] ?? '' }}</a>
                                        </div>
                                        <h2><a href="{{ $link ?? '' }}">{{ $item['ModelName'] ?? '' }} {{ $item['Color'] ?? '' }} {{ $item['Memory'] ?? '' }} {{ $item['SimLock'] ?? '' }} {{ ($item['Status']==2)?'<span class="label label-outline-danger label-pill label-inline mr-2">Sold</span>':'' }}</a></h2>
                                        <div>
                                            <span>
                                                <span> <strong>Region Code </strong> :  {{ $item['Regioncode'] ?? '' }}</span>
                                            </span>
                                        </div>
                                        <div>
                                            <span>
                                                <span> <strong>Grade </strong> :  {{ $item['Grade'] ?? '' }}</span>
                                            </span>
                                        </div>
                                        <div>
                                            <span>
                                                <span> <strong>Condition </strong> :  {{ $item['Condition'] ?? '' }}</span>
                                            </span>
                                        </div>
                                        <div>
                                            <span>
                                                <span> <strong>Description </strong> :  {{ $item['Description'] ?? '' }}</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>  {{ str_contains($item['Price'], '$')?$item['Price']: '$'.$item['Price']}}</span>
                                            <!-- <span class="old-price">$245.8</span> -->
                                        </div>
                                        <div class="product-action-1 show">
                                            <a  aria-label="Get Report" class="action-btn hover-up" target="_blank" href="https://drfonescloud.com/cloud-lookup-qr?IMEI={{ $item['Imei'] ?? '' }}&USERID={{ request()->id }}"><i class="fi-rs-file"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                                <p>No Data Found</p>
                            </div>
                        @endforelse
                    </div>
                    @if($total > 0)
                    <!--pagination-->
                    <?php
                        $page=1;
                        if (isset($_GET["page"]))
                            $page  = $_GET["page"];

                        $totalPages = ceil($total / $limit);

                        $count = 3;
                        $startPage = max(1, $page - $count);
                        $endPage = min( $totalPages, $page + $count);

                        $prev = $page - 1;
                        $next = $page + 1;
                    ?>
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                                    <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo request()->fullUrlWithQuery(['page' =>  $prev]); } ?>" aria-label="Previous" >
                                    <i class="fas fa-angle-left"></i>
                                    </a>
                                </li>
                                <?php for($i = $startPage; $i <= $endPage; $i++ ): ?>
                                    <li class="page-item <?php if($page == $i) {echo 'active'; } ?>"><a class="page-link" href="{{ request()->fullUrlWithQuery(['page' =>  $i]) }}"><?= $i; ?></a></li>
                                <?php endfor; ?>
                                <li class="page-item <?php if($page >= $totalPages) { echo 'disabled'; } ?>">
                                    <a class="page-link" href="<?php if($page >= $totalPages){ echo '#'; } else {echo request()->fullUrlWithQuery(['page' =>  $next]); } ?>" aria-label="Next">
                                    <i class="fas fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @endif
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    @include('frontend.products.partials.filter')
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('script-bottom')
@endsection
