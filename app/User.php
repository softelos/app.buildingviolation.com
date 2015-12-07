<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $guarded=['id','password_confirmation','avatar'];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    
    // Relationships
   
    // Violations Model
    public function violations(){
        return $this->hasMany('App\Violation','user_id');
    }
    public function awarded(){
        return $this->hasMany('App\Violation','pro_uid');
    }
    
    // Offer Model
    public function offers(){
        return $this->hasMany('App\Offer','pro_id','id');
    }
    
    // Comment Model
    public function comments(){
        return $this->hasMany('App\Comment','offer_id','id');
    }
    
    // Accessors
    public function getUserTypeAttribute($value){
        return config('other.user_types.'.$value);
    }
    public function getProTypeAttribute($value){
        return config('other.pro_types.'.$value);
    }
    public function getLicensedAttribute($value){
        return ($value==true) ? 'Yes' : 'No';
    }
    
    // Mutators
    public function setLicensedAttribute($value){
        $this->attributes['licensed']=($value=='Yes' ? 1 : 0);
    }

}
