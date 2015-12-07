<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //
    public $fillable=['response','pro','quality'];
    
    public function offer(){
        return $this->belongsTo('App\Offer','offer_id','id');
    }
}
