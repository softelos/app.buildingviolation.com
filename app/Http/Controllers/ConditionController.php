<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Gate;
use Session;

use App\Offer;
use App\Condition;

class ConditionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    // Post (store)
    public function store($offer_id,Requests\SaveConditionRequest $request){        
        // Find offer to make sure it exists
        $offer=Offer::findOrFail($offer_id);
        
        if(Gate::denies('add-condition',$offer)) abort(403);
                
        // Create new condition and save
        $condition=new Condition;
        $condition->fill($request->input());
        $condition->offer_id=$offer_id;
        $condition->pro_id=Auth::user()->id;
        $condition->save();
        // Flash message
        Session::flash('message', 'You have added a new condition to the offer.');
        Session::flash('message-type','success');
        // Redirect                
        return redirect(url('/offer/'.$offer_id.'#conditions'));
                
    }
    
    // Delete condition
    public function destroy($condition_id){
        $condition=Condition::findOrFail($condition_id);
        if(Gate::denies('delete-condition',$condition)) abort(403);   
        $offer_id=$condition->offer->id;     
        $condition->delete();
        // Flash message
        Session::flash('message', 'You have deleted a condition from the offer.');
        Session::flash('message-type','success');
        // Redirect                
        return redirect(url('/offer/'.$offer_id.'#conditions'));
    }
}
