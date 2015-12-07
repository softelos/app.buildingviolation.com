<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;
use Auth;
use Session;
use Mail;

use App\Rate;
use App\Offer;

class RateController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    // Store
    public function store($offer_id,Request $request){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('close-offer',$offer)) abort(403);
        
        $rate=new Rate;
        $rate->fill($request->input());
        $rate->pro_id=Auth::user()->id;
        $rate->offer_id=$offer_id;        
        $rate->save();        
        $offer->status=6;
        $offer->save();
        // Send email
        $violation=$offer->violation;
        $violation->status=6;
        $violation->save();
        $email=$offer->author->email;
        $to=$offer->author->username;
        $customer_name=$offer->violation->author->username;
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
        $offer_id=$offer->id;
        $data=compact('to','customer_name','address','offer_id');
        Mail::send('emails.offerclosed', $data, function ($message) use ($email){
            $message->subject('You have been reviewed!');
            $message->to($email);
        });                                
        // Flash message
        Session::flash('message', 'You have submitted a review and closed this offer.');
        Session::flash('message-type','success');     
        // Redirect   
        return redirect()->action('OfferController@show',[$offer_id]);
    }
}
