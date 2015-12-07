<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    
    public $fillable=['fee','cost','bv_cost','total'];

    // Relationships
    public function author(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function offer(){
        return $this->belongsTo('App\Offer','offer_id','id');
    }
    
    // Accessors
    public function getFeeAttribute($value){
        return $value.'%';
    }
    public function getCostAttribute($value){
        return sprintf('$%1.2f',$value);
    }
    public function getBvCostAttribute($value){
        return sprintf('$%1.2f',$value);
    }
    
    public function getTotalAttribute($value){
        return sprintf('$%1.2f',$value);
    }

}
