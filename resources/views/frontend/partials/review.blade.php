
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
