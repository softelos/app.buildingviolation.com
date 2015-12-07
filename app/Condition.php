<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{

    public $fillable=['body','deadline'];
    
    public function author(){
        return $this->belongsTo('App\User','pro_id','id');
    }
    public function offer(){
        return $this->belongsTo('App\Offer','offer_id','id');
    }
    
}
