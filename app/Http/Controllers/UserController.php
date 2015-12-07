<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Session;
use Response;
use Auth;

use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    // Index
    public function index(){
        $users=User::all();
        $users_count=count($users);
        return view('user.index',compact('users','users_count'));
    }
    // Show
    public function show($id){
        $user=User::findOrFail($id);
        $violations=$user->violations;
        $violations_count=count($violations);
        $offers=$user->offers;
        $offers_count=count($offers);
        if(Auth::user()->id==$user->id) $sidebar_active_menu='account';
        else $sidebar_active_menu='users';

        return view('user.show',compact('user','violations','violations_count','offers','offers_count','sidebar_active_menu'));
    }
    
    // Edit
    public function edit($id){
        $user=User::findOrFail($id);
        $states=config('other.states');
        $pro_types=config('other.pro_types');
        return view('user.edit',compact('user','states','pro_types'));
    }
    
    // Update
    public function update(Requests\SaveUserRequest $request, $id){
        $user=User::findOrFail($id);
        // Account and contact information
        $old_password=$user->password;
        $user->fill($request->input());
        $new_password=$request->input('password');
        if(!empty($new_password)) $user->password=bcrypt($new_password);
        else $user->password=$old_password;
        // Avatar picture
        
        $file=Input::file('avatar');
        if($file){
            $path='uploads/avatars';
            $extension=$file->getClientOriginalExtension();
            $fileName=$user->username.'.'.$extension;
            $file->move($path,$fileName);
            Session::flash('success','Upload successfully');
            $user->avatar=$fileName;
        }
        
        // Save
        $user->save();
        // Redirect
        return redirect()->action('UserController@show',[$user->id]); 
    }

    public function avatar_upload($user_id){
        $user=User::findOrFail($user_id);
        $file=Input::file('avatar');
        if($file){
            $path='uploads/avatars';
            $extension=$file->getClientOriginalExtension();
            $fileName=$user->username.'.'.$extension;
            $file->move($path,$fileName);
            Session::flash('success','Upload successfully');
            $user->avatar=$fileName;
            $data=[
                'name'=>$fileName,
                'size'=>$size,
                'url'=>$path
            ];
        }else $data=[];
        return Response::json($data);

    }
}
