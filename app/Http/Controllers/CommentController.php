<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Gate;
use Session;
use Mail;

use App\Offer;
use App\Comment;

class CommentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    // Post (Store)
    public function store(Requests\SaveCommentRequest $request,$offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('add-comment',$offer)) abort(403);        
        $comment=new Comment;
        $comment->fill($request->input());        
        $comment->user_id=Auth::user()->id;
        $comment->offer_id=$offer_id;        
        $comment->save();
        $violation=$offer->violation;
        // Send email
        $user_type=Auth::user()->getOriginal('user_type');
        if($user_type=='cus'){
            $to=$offer->author->username;
            $email=$offer->author->email;
        }else{
            $to=$violation->author->username;
            $email=$violation->author->email;
        }        
        $poster_name=Auth::user()->username;  
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;                    
        $data=compact('user_type','to','poster_name','address','offer_id');
        Mail::send('emails.newcomment', $data, function ($message) use ($email){
            $message->subject('New Comment Posted');
            $message->to($email);
        });
        // Flash message
        Session::flash('message', 'Your comment has been posted to the offer.');
        Session::flash('message-type','success');
        // Redirect        
        return redirect(url('/offer/'.$offer_id.'#comment_'.$comment->id));
    }
}
