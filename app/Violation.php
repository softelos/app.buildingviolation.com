<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    // Guarded attributes
    
    public $guarded=['id','uid','pro_id','offers','status'];
    
    protected $dates=['hearing_date'];
 
    // RELATIONSHIPS
    
    // User
    public function author(){
        return $this->belongsTo('App\User','user_id','id');
    } 
    public function proAwarded(){
        return $this->belongsTo('App\User','pro_id','id');
    }
    
    // Offer
    public function offers(){
        return $this->hasMany('App\Offer','violation_id','id');
    }
    
    
    // GETTERS
    
    public function bOffertable(){
        return $this->offers==0;
    }
    
    
    // ACCESSORS
    public function getStateAttribute($value){
        return config('other.states.'.$value);
    }
    public function getClassAttribute($value){
        return config('other.violation_class.'.$value);        
    }
    public function getTypeAttribute($value){
        return config('other.violation_type.'.$value);                
    }
    public function getReporterAttribute($value){
        return config('other.violation_reporter.'.$value);                
    }
    public function getHearingDateMissedAttribute($value){
        return ($value==1 ? 'Yes' : 'No');        
    }
    public function getGuiltAdmitAttribute($value){
        return ($value==1 ? 'Yes' : 'No');        
    }    
    public function getCorrectedAttribute($value){
        return ($value==1 ? 'Yes' : 'No');
    }
    public function getCorrectionAuthorAttribute($value){
        return config('other.violation_corrector.'.$value);                        
    }
    public function getStatusAttribute($value){
        //return config('other.status.'.$value);
        return config('other.stage_status.'.$value);
    }
    
    // Mutators
    public function setHearingDateAttribute($value){
        $this->attributes['hearing_date']=strtotime($value);
    }
    public function setHearingDateMissedAttribute($value){
        $this->attributes['hearing_date_missed']=($value=='Yes' ? 1 : 0);        
    }
    public function setGuiltAdmitAttribute($value){
        $this->attributes['guilt_admit']=($value=='Yes' ? 1 : 0);        
    }    
    public function setCorrectedAttribute($value){
        $this->attributes['corrected']=($value=='Yes' ? 1 : 0);        
    }


    // Other
    public function getShortDescription($max){
        $str=$this->description;
        if(strlen($str)>$max) $str=substr($this->description,0,$max).'..';
        return $str;
    }
    public function getShortECB(){
        $max=20;
        $str=$this->ecb;
        if(strlen($str)>$max) $str=substr($this->ecb,0,$max).'..';
        return $str;
    }
    
}
