<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    // Guarded attributes
    public $guarded=['id','pro_id','customer_id','violation_id','status','paid','awarded'];
    
    // Relationships
    public function violation(){
        return $this->belongsTo('App\Violation','violation_id','id');
    }
    public function author(){
        return $this->belongsTo('App\User','pro_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Comment','offer_id','id');
    }
    public function conditions(){
        return $this->hasMany('App\Condition','offer_id','id');
    }
    public function rate(){
        return $this->hasOne('App\Rate','offer_id','id');
    }
        
    // Accessors
    public function getStatusAttribute($value){
        return config('other.stage_status.'.$value);
    }
    
    // Mutators
}
