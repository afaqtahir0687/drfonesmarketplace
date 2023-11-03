<h4 class="mb-30">Customer reviews</h4>
<div class="d-flex mb-30">
    <div class="product-rate d-inline-block mr-15">
        <div class="product-rating" style="width:{{ $avg_percentage }}%">
        </div>
    </div>
    <h6>{{ $avg_ratings }} out of 5</h6>
</div>
@php
$total = $comments->count();
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
