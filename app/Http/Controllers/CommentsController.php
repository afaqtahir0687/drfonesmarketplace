<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;




class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = $request->session()->get('user_data');
       
        if($request->mode == "add")
        {
            $obj = new Comments();
            $obj->name = $request->name;
            $obj->contact_no = $request->contact_no;
            $obj->imei = $request->imei;
            $obj->parent_id = $request->parent_id;
            $obj->rating = $request->rating;
            $obj->comments = $request->comment;
            $obj->user_id = $userData['ID'];
            $obj->save();
    
    
            $comments = Comments::where('imei',$obj->imei)->get();
            $total = $comments->count();
    
            $avg_ratings = Comments::where('imei',$obj->imei)->selectRaw('SUM(rating)/COUNT(imei) AS avg_rating')->first()->avg_rating;
            $avg_ratings = round($avg_ratings, 1);
            $avg_percentage = $avg_ratings * 2 * 10;
    
            $html = view('frontend.partials.review', compact('comments'))->render();
            $customer_review_html = view('frontend.partials.customer_review', compact('comments', 'avg_ratings', 'avg_percentage'))->render();
            return Response::json(['status' => 200, 'html' => $html, 'review_count' => $total, 'customer_review_html' => $customer_review_html]);

        }
        else
        {
            
            $obj = Comments::find($request->id);
            $obj->name = $request->name;
            $obj->contact_no = $request->contact_no;
            $obj->imei = $request->imei;
            $obj->parent_id = $request->parent_id;
            $obj->rating = $request->rating;
            $obj->comments = $request->comment;
            $obj->user_id = $userData['ID'];
            $obj->save();

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comments::find($id);

        $comment->delete();

        return back();
    }
    public function getReview(Request $request)
    {
        $comment = Comments::find($request->id);

        $html = view('frontend.partials.edit-review', compact('comment'))->render();
        
        return Response::json(['status' => 200, 'html' => $html]);

        
    }
}
