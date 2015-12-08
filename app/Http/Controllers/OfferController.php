<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Gate;
use Session;
use Mail;
use PayPal;

use App\Violation;
use App\Offer;
use App\Comment;
use App\Condition;
use App\Payment;

class OfferController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    // Index
    public function index(){
        // This view changes dependin on the type of user
        $user_id=Auth::user()->id;
        $user_type=Auth::user()->getOriginal('user_type');
        if($user_type=='cus') $offers=Offer::where('user_id',$user_id)->get();
        else $offers=Offer::all();
        $total=count($offers);
        return view('offer.index',compact('offers','total'));   
    }
    
    // Create
    public function create($violation_id){
        if(Gate::denies('create-offer')) abort(403);        
        $violation=Violation::findOrFail($violation_id);
        $edit=false;
        return view('offer.create',compact('violation','edit'));
    }

    // Show
    public function show($id){
        $offer=Offer::findOrFail($id);
        if(Gate::denies('full-view-offer',$offer)) abort(403);
        // Get violation
        $violation=$offer->violation;
        // Get all comments
        $comments=Comment::where('offer_id',$id)->get();
        $comments_count=count($comments);
        // Get all conditions
        $conditions=Condition::where('offer_id',$id)->get();
        $conditions_count=count($conditions);
        // Payment values
        $payment_fee=config('other.fee');
        $payment=[
            'fee'=>$payment_fee.'%',
            'pro'=>'$'.$offer->cost,
            'bv'=>'$'.$offer->cost*($payment_fee/100),
            'total'=>'$'.$offer->cost*(1+($payment_fee/100))
        ];        
        // Rates
        $rates=config('other.rates');
        return view('offer.show',compact('offer','violation','comments','comments_count','conditions','conditions_count','payment','rates'));
    }
    
    // Store
    public function store(Requests\SaveOfferRequest $request){
       if(Gate::denies('create-offer')) abort(403);
                
       $violation_id=$request->input('violation_id');
       $violation=Violation::findOrFail($violation_id);
       
       $offer=new Offer;
       $offer->fill($request->input());
       $offer->violation_id=$violation_id;
       $offer->pro_id=Auth::user()->id;   
       $offer->user_id=$violation->author->id;
       $offer->save();
       
       // Update violation
       $violation->offers++;
       $violation->status=0;
       $violation->save();

       // Send email
       $email=$violation->author->email;
       $to=$violation->author->username;
       $pro_name=$offer->author->username;
       $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
       $offer_id=$offer->id;
       $data=compact('to','pro_name','address','offer_id');
       Mail::send('emails.newoffer', $data, function ($message) use ($email){
            $message->subject('You have received an offer');
            $message->to($email);
        });
    

        // Flash message
        $violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;        
        Session::flash('message', 'Your offer for violation <b>'.$violation_name.'</b> has been submitted.');
        Session::flash('message-type','success');
        // Redirect                       
       return redirect()->action('OfferController@show',[$offer->id]);
    }
    
    // Edit
    public function edit($offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('edit-offer',$offer)) abort(403);                
        $violation=$offer->violation;
        $edit=true;
        return view('offer.edit',compact('offer','violation','edit'));
    }
    
    // Update
    public function update($offer_id,Requests\SaveOfferRequest $request){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('edit-offer',$offer)) abort(403);
        $offer->fill($request->input());
        $offer->save();
        // Flash message
        $violation=$offer->violation;
        $violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;        
        Session::flash('message', 'Your offer for violation <b>'.$violation_name.'</b> has been updated.');
        Session::flash('message-type','success');
        // Redirect
        return redirect()->action('OfferController@show',[$offer->id]);
    }
    
    // Destroy
    public function destroy($offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('delete-offer',$offer)) abort(403);        
        $violation=$offer->violation;        
        $offer->delete();
        $violation->offers--;
        $violation->save();
        return redirect()->action('ViolationController@show',[$violation->id]);
    }
    
    // Award
    public function award($id){
        $offer=Offer::findOrFail($id);
        $violation=$offer->violation;
        
        if($violation->getOriginal('status')==0){
            $offer->status=1; // Awarded
            $offer->awarded=1;
            $offer->save();
            $violation->status=1;   // Awarded
            $violation->pro_id=$offer->author->id;
            $violation->save();           
            // Send email
           $email=$offer->author->email;
           $to=$offer->author->username;
           $customer_name=$offer->violation->author->username;
           $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
           $offer_id=$offer->id;
           $data=compact('to','customer_name','address','offer_id');
           Mail::send('emails.offerawarded', $data, function ($message) use ($email){
                $message->subject('Your offer has been awarded!');
                $message->to($email);
            });

            // Flash message
            $violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;                    
            Session::flash('message', 'You have awarded this offer for violation <b>'.$violation_name.'</b>.');
            Session::flash('message-type','success');
            // Redirect        
            return redirect()->action('OfferController@show',[$offer->id]);
        }else abort(403);
    }
    
    // Remove Award
    public function remove_award($offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('remove-award',$offer)) abort(403);        
        // Update Offer status
        $offer->status=0;
        $offer->save();        
        // Update Violation status
        $violation=$offer->violation;
        $violation->status=0;
        $violation->save();        
        // Delete all conditions asociated with this offer
        Condition::where('offer_id',$offer_id)->delete();
        // Send email
        $email=$offer->author->email;
        $to=$offer->author->username;
        $customer_name=$offer->violation->author->username;
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
        $offer_id=$offer->id;
        $data=compact('to','customer_name','address','offer_id');
        Mail::send('emails.revokeofferaward', $data, function ($message) use ($email){
            $message->subject('Your offer is no longer awarded!');
            $message->to($email);
        });
        // Flash message
        Session::flash('message', 'You have revoked the award to this offer.');
        Session::flash('message-type','success');
        // Redirect        
        return redirect()->action('OfferController@show',[$offer_id]);
    }
    
    // Submit Conditions
    public function submit_conditions($offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('submit-conditions',$offer)) abort(403);
        // Update Offer
        $offer->status=2;
        $offer->save();
        // Update Violation
        $violation=$offer->violation;
        $violation->status=2;
        $violation->save();
        // Send email
        $email=$offer->violation->author->email;
        $to=$offer->violation->author->username;
        $pro_name=$offer->author->username;
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
        $offer_id=$offer->id;
        $data=compact('to','pro_name','address','offer_id');
        Mail::send('emails.submitconditions', $data, function ($message) use ($email){
            $message->subject('You have received new conditions to review');
            $message->to($email);
        });        
        // Flash message
        Session::flash('message', 'You have submitted all the conditions to <b>'.$violation->author->username.'</b>.');
        Session::flash('message-type','success');
        // Redirect
        return redirect()->action('OfferController@show',[$offer_id]);
    }
    
    // Accept Conditions
    public function accept_conditions($offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('accept-conditions',$offer)) abort(403);
        // Update Offer
        $offer->status=3;
        $offer->save();
        // Update Violation
        $violation=$offer->violation;
        $violation->status=3;
        $violation->save();
        // Send email
        $email=$offer->author->email;
        $to=$offer->author->username;
        $customer_name=$offer->violation->author->username;
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
        $offer_id=$offer->id;
        $data=compact('to','customer_name','address','offer_id');
        Mail::send('emails.acceptconditions', $data, function ($message) use ($email){
            $message->subject('Your conditions have been accepted!');
            $message->to($email);
        });                
        // Flash message
        Session::flash('message', 'You have accepted the conditions submitted by the pro <b>'.$offer->author->username.'</b> for this offer.');
        Session::flash('message-type','success');
        // Redirect
        return redirect()->action('OfferController@show',[$offer_id]);
    }
    
    // Process Payment
    public function pay($offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('pay-offer',$offer)) abort(403);
        
        // Calculate total
        $cost=$this->getCost($offer_id);        
        // Proceed
        $data['items']=[
            [
                'name'=>'BuildingViolation#'.$offer->violation->id,
                'price'=>$cost['pro_cost']
            ],
            [
                'name'=>'BuildingViolation Fee ('.$cost['fee'].'%)',
                'price'=>$cost['bv_cost']
            ]            
        ];
        $data['total']=$cost['total'];
        $data['invoice_id']=$offer_id;
        $data['invoice_description']='Order for violation Invoice';
        $data['return_url']=url('/offer/payment_success/'.$offer_id);
        $data['cancel_url']=url('/offer/payment_fail/'.$offer_id);
        
        $response=PayPal::setExpressCheckout($data);
        return redirect($response['paypal_link']);
  
    }
    
    public function payment_success($offer_id){
        // Set the offer to paied and increase stage
        // Update the Offer
        $offer=Offer::findOrFail($offer_id);
        $offer->paid=1;
        $offer->status=4;
        $offer->save();
        // Register the payment
        $cost=$this->getCost($offer_id);
        $payment=new Payment;
        $payment->user_id=Auth::user()->id;
        $payment->offer_id=$offer_id;
        $payment->fee=$cost['fee'];
        $payment->cost=$cost['pro_cost'];
        $payment->bv_cost=$cost['bv_cost'];
        $payment->total=$cost['total'];        
        $payment->save();
        // Send email
        $violation=$offer->violation;
        $violation->status=4;
        $violation->save();
        $email=$offer->author->email;
        $to=$offer->author->username;
        $customer_name=$offer->violation->author->username;
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
        $offer_id=$offer->id;
        $data=compact('to','customer_name','address','offer_id');
        Mail::send('emails.paymentmade', $data, function ($message) use ($email){
            $message->subject('Offer paid!');
            $message->to($email);
        });   
        // Send email to the admin
        $email=config('other.email');
        $to='Admin';
        $customer_name=$offer->violation->author->username;
        $pro_name=$offer->author->username;
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
        $data=compact('to','customer_name','pro_name','address','offer_id');
        Mail::send('emails.paymentmadeadmin', $data, function ($message) use ($email){
            $message->subject('New Payment!');
            $message->to($email);
        });                                                             
        // Flash message
        Session::flash('message', 'You have made a payment of <b>'.$payment->total.'</b> for this offer. The pro <b>'.$offer->author->username.'</b> can start now working on it.');
        Session::flash('message-type','success');
        // Redirect
        return redirect()->action('OfferController@show',[$offer_id]);    
    }
    public function payment_fail($offer_id){
        Session::flash('message', 'Something went wrong with the payment. Please try again.');
        Session::flash('message-type','danger');
        return redirect()->action('OfferController@show',[$offer_id]);    
    }
    
    // Calculate the offer cost and others
    // This function is used by other places
    public function getCost($offer_id){
        $offer=Offer::findOrFail($offer_id);               
        $fee=config('other.fee');
        $pro_cost=(float)$offer->cost;
        $bv_cost=$pro_cost*($fee/100);
        $total=$pro_cost*(1+($fee/100));        
        return compact('fee','pro_cost','bv_cost','total');
    }
    
    // Report completed, Pro does this
    public function report_completed($offer_id){
        $offer=Offer::findOrFail($offer_id);
        if(Gate::denies('complete-offer',$offer)) abort(403);        
        // Update offer
        $offer->status=5;
        $offer->save();
        // Update violation
        $violation=$offer->violation;
        $violation->status=5;
        $violation->save();
        // Send email to the pro
        $email=$offer->violation->author->email;
        $to=$offer->violation->author->username;
        $pro_name=$offer->author->username;
        $address=$violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;  
        $offer_id=$offer->id;
        $data=compact('to','pro_name','address','offer_id');
        Mail::send('emails.offercompleted', $data, function ($message) use ($email){
            $message->subject('Offer Completed!');
            $message->to($email);
        });                                
        // Flash message
        Session::flash('message', 'You have reported that you have completed solving this violation. The customer <b>'.$violation->author->username.'</b> needs to review before it can be closed.');
        Session::flash('message-type','success');
        // Redirect
        return redirect()->action('OfferController@show',[$offer_id]);
    }        
}
