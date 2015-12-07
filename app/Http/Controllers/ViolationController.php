<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Gate;

use Auth;
use App\Violation;

class ViolationController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['except'=>['get_violations','violation_map','create','store']]);
    }

    // Index (lists all violations)
    public function index(){
        $violations=Violation::where('user_id','>',0)->get();    
        $total=count($violations);        
        $states=config('other.states');
        return view('violation.index',compact('violations','total','states'));
    }

    // Lists violations created by the logged user (customer)
    public function my_violations(){
        $uid=Auth::user()->id;
        $violations=Violation::where('user_id',$uid)->get();    
        $total=count($violations);
        return view('violation.my-violations',compact('violations','total'));   
    }    
    
    // Show (displays one single violation)
    public function show($id){
        $uid=Auth::user()->id;
        $violation=Violation::findOrFail($id);
        if($uid==$violation->user_id) $owned_by_user=true;
        else $owned_by_user=false;
        $offers=$violation->offers()->get();
        $total_offers=count($offers);
        return view('violation.show',compact('violation','owned_by_user','offers','total_offers'));
    }
    
    // Destroy (deletes a violation)
    public function destroy($violation_id){
        $violation=Violation::findOrFail($violation_id);
        $violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;
        $violation->delete();
        // Flash message
        Session::flash('message', 'Violation <b>'.$violation_name.'</b> has been deleted.');
        Session::flash('message-type','success');
        // Return        
        return redirect('/my-violations');
    }
    
    // Create (shows form to create a new vioalation)
    public function create(){
        if(Auth::check()){
            if(Gate::denies('create-violation')) abort(403);
        }

        $states=config('other.states');
        $classes=config('other.violation_class');
        $types=config('other.violation_type');
        $reporters=config('other.violation_reporter');
        $correctors=config('other.violation_corrector');
        $edit=false;
        if(Auth::check()) return view('violation.create',compact('states','classes','types','reporters','correctors','edit'));
        else return view('violation.create-unregistered',compact('states','classes','types','reporters','correctors','edit'));
    }
    
    // Store (post, stores a new violation)
    public function store(Requests\SaveViolationRequest $request){
        if(Auth::check()){
            if(Gate::denies('create-violation')) abort(403);
        }
        
        // Store
        $violation=new Violation;
        $violation->fill($request->input());        
        $violation->status=0;
        $violation->offers=0;        

        if(Auth::check()) $violation->user_id=Auth::user()->id;
        else $violation->user_id=0;
        $violation->save();        

        if(!Auth::check()){
            // User is not registered, we save the violation-id in the session, flag, so we can come back later.
            session(['unregistered-violation'=>true]);
            session(['violation_id'=>$violation->id]);
            return redirect('signup-customer');
        }else{
            // Flash message
            $violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;        
            Session::flash('message', 'Violation <b>'.$violation_name.'</b> has been created.');
            Session::flash('message-type','success');
            // Redirect                
            return redirect()->action('ViolationController@show',[$violation->id]);
        }
    }
    
    // Edit (single violation)
    public function edit($id){
        
        $violation=Violation::findOrFail($id);
        $states=config('other.states');
        $classes=config('other.violation_class');
        $types=config('other.violation_type');
        $reporters=config('other.violation_reporter');
        $correctors=config('other.violation_corrector');
        $edit=true;        
        return view('violation.edit',compact('violation','states','classes','types','reporters','correctors','edit'));
    }
    
    // Update (POST for Edit)
    public function update(Requests\SaveViolationRequest $request,$id){

        if(Gate::denies('create-violation')) abort(403);
        
        $violation=Violation::findOrFail($id);
        $violation->fill($request->input());        
        $violation->save();  
        // Flash message
        $violation_name=$violation->address1.', '.$violation->city.' ('.$violation->getOriginal('state').') '.$violation->zip;        
        Session::flash('message', 'Violation <b>'.$violation_name.'</b> has been updated.');
        Session::flash('message-type','success');
        // Redirect                      
        return redirect()->action('ViolationController@show',['id'=>$id]);
    }

    // This method returns to the static page the last violations created
    public function get_violations(){
        $violations=Violation::limit(3)->orderBy('id','desc')->get();
        $violations_count=count($violations);
        return view('violation.list-remote',compact('violations','violations_count'));
    }

    public function violation_map($state){
        $states=config('other.states');
        $state_name=$states[strtoupper($state)];
        $violations=Violation::where('state',strtoupper($state))->where('user_id','>',0)->get();
        $violations_count=count($violations);        
        return view('violation.violation-map',compact('state_name','violations','violations_count'));
    }

    
}
