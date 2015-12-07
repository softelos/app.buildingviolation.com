<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Mail;

use App\Violation;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    protected $loginPath='/sign-in';
    protected $redirectPath='/user/';
    protected $username='username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'=>'required|max:60|min:8|unique:users',
            'email' => 'required|email|max:254|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data,$type)
    {
        if($type=='cus'){
            return User::create([
                'username'=>$data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'user_type'=>$type,
            ]);
        }else{
            return User::create([
                'username'=>$data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'user_type'=>$type,
                'pro_type'=>$data['pro_type']
            ]);            
        }
    }
    
    // Override method that shows the register form
    public function getRegisterCustomer(){
        return view('auth.register_customer');       
    }

    public function getRegisterPro(){
        $pro_types=config('other.pro_types');
        return view('auth.register_pro',compact('pro_types'));       
    }
    
    // Override methods that post the register forms
    public function postRegisterCustomer(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        // Create and log the user in
        Auth::login($this->create($request->all(),'cus'));
       
       // Send email to the user and admin
        $to=Auth::user()->username;
        $user_id=Auth::user()->id;
        $user_type='cus';
        $email=Auth::user()->email;
        $data=compact('to','user_id','user_type');
        // User
        Mail::send('emails.newuser', $data, function ($message) use ($email){
            $message->subject('Welcome!');
            $message->to($email);
        });
        // Admin
        Mail::send('emails.newuser-admin', $data, function ($message){
            $message->subject('New User');
            $message->to(config('other.email'));
        });
        
        if(session('unregistered-violation')){
            session(['unregistered-violation'=>false]);
            $violation=Violation::findOrFail(session('violation_id'));
            $violation->user_id=Auth::user()->id;
            $violation->save();
            return redirect()->action('ViolationController@show',[$violation->id]);
        }else{
            $this->redirectPath = $this->redirectPath . Auth::user()->id;
            return redirect($this->redirectPath());
        }
    }

    public function postRegisterPro(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        // Set the type of user to customer
        Auth::login($this->create($request->all(),'pro'));
       // Send email to the user and admin
        $to=Auth::user()->username;
        $user_id=Auth::user()->id;
        $user_type='pro';
        $email=Auth::user()->email;
        $data=compact('to','user_id','user_type');
        // User
        Mail::send('emails.newuser', $data, function ($message) use ($email){
            $message->subject('Welcome!');
            $message->to($email);
        });
        // Admin
        Mail::send('emails.newuser-admin', $data, function ($message){
            $message->subject('New User');
            $message->to(config('other.email'));
        });

        $this->redirectPath = $this->redirectPath . Auth::user()->id;
        return redirect($this->redirectPath());
    }

    public function postRegister(Request $request){

        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $this->redirectPath = $this->redirectPath . Auth::user()->id;
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

}
