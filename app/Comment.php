<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Fillable
    public $fillable=['body'];
    
    // Relationships    
    public function author(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
    public function offer(){
        return $this->belongsTo('App\Offer','offer_id','id');
    }
    
    
}
