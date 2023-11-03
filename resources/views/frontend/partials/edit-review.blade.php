
<form class="form-contact comment_form" action="{{ route('review.store', $comment->id) }}" method="POST"
    id="commentForm">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="rate edit-rating-stars">
                <input type="radio" id="star5" class="rate" @if($comment->rating == 5) checked @endif name="rating"
                value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" class="rate" @if($comment->rating == 4) checked @endif name="rating"
                value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" @if($comment->rating == 3) checked @endif class="rate" name="rating"
                value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" @if($comment->rating == 2) checked @endif class="rate" name="rating"
                value="2">
                <label for="star2" title="text">2 stars</label>
                <input type="radio" @if($comment->rating == 1) checked @endif id="star1" class="rate" name="rating"
                value="1" />
                <label for="star1" title="text">1 star</label>
            </div>
            <input type="hidden" name="id" value="{{ $comment->id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->parent_id }}">
            <input type="hidden" name="mode" value="edit">
            <input type="hidden" name="imei" value="{{ $comment->imei }}">
        </div>
        <div class="col-12">
            <div class="form-group">
                <textarea class="form-control w-100" required name="comment" id="comment" style="height:80px" cols="30" rows="9"
                    placeholder="Write Comment">{{ $comment->comments }}</textarea>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input class="form-control" name="name" value="{{ $comment->name }}" required id="name" type="text"
                    placeholder="Name">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input class="form-control" name="contact_no" value="{{ $comment->contact_no }}" required id=""
                    type="text" placeholder="Contact No">
            </div>
        </div>
      
    </div>
    <div class="form-group">
        <button type="submit" class="button button-contactForm">Edit
            Review</button>
    </div>
</form>