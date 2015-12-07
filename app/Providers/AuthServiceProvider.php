<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // USERS

        $gate->define('see-email',function($user,$profile){
            if(($user->id==$profile->id)
                OR ($user->id==1)) return true;
            else return false;
        });

        // VIOLATIONS
        
        // Create (only Customers)
        $gate->define('create-violation', function($user){
            return $user->getOriginal('user_type')=='cus';
        });
        // Edit (only Author)
        $gate->define('edit-violation',function($user,$violation){
            return $violation->user_id==$user->id;
        });
        // Delete (only Author)
        $gate->define('delete-violation',function($user,$violation){
            return $violation->user_id==$user->id;
        });
        
        // OFFERS
        $gate->define('see-offers',function($user){
            return ($user->getOriginal('user_type')=='pro');
        });

        // Create (only Pros)
        $gate->define('create-offer', function($user){
            return $user->getOriginal('user_type')=='pro';
        });
        // Edit (only Author)
        $gate->define('edit-offer',function($user,$offer){
            if(($offer->author->id==$user->id)
                AND ($offer->getOriginal('status')<1)) return true;
            else return false;
        });
        // Delete (only Author)
        $gate->define('delete-offer',function($user,$offer){
            if(($offer->author->id==$user->id)
                AND ($offer->getOriginal('status')<1)) return true;
            return false;
        });
        
        // Full view (only author of Violation and author of Offer)
        $gate->define('full-view-offer',function($user,$offer){
            if(($offer->author->id==$user->id) OR ($offer->violation->author->id==$user->id)) return true;
            else return false;
        });
        
        // Send offer (only Pros)
        $gate->define('send-offer',function($user,$violation){
            $offers=\App\Offer::where(['violation_id'=>$violation->id,'pro_id'=>$user->id])->get();
            if(count($offers)) return false;
            else return true;
        });
        
        // Award Offer (only Customers)
        $gate->define('award-offer',function($user,$offer){
            if(($offer->violation->user_id==$user->id) 
                AND ($offer->getOriginal('status')==0)
                AND ($offer->violation->getOriginal('status')==0)) return true;
            else return false;
        });
        
        // Remove Award offer (only customer)
        $gate->define('remove-award',function($user,$offer){
            if(($offer->violation->author->id==$user->id)
                AND ($offer->getOriginal('status')>0) 
                AND ($offer->getOriginal('status')<3)) return true;
            else return false;
        });
        
        // Submit comments
        $gate->define('add-comment',function($user,$offer){
            if(($user->id==$offer->violation->user_id)
                OR ($user->id==$offer->author->id)) return true;
            else return false;
        });

        // Submit conditions
        $gate->define('submit-conditions',function($user,$offer){
            if(($user->id==$offer->author->id)
                AND (count($offer->conditions)>0)
                AND ($offer->getOriginal('status')>0)
                AND ($offer->getOriginal('status')<2)) return true;
            else return false;
        });
        
        // Add new condition
        $gate->define('add-condition',function($user,$offer){
            if(($user->id==$offer->author->id)
                AND ($offer->getOriginal('status')>0)
                AND ($offer->getOriginal('status')<3)) return true;
            else return false;
        });
        
        // Delete condition
        $gate->define('delete-condition',function($user,$condition){
            $offer=$condition->offer;
            if(($user->id==$offer->author->id)
                AND ($user->id==$condition->author->id)
                AND ($offer->getOriginal('status')>0)
                AND ($offer->getOriginal('status')<3)) return true;
            else return false;
        });

        // Accept Offer Conditions
        $gate->define('accept-conditions',function($user,$offer){
            if(($user->id==$offer->violation->author->id)
                AND ($offer->getOriginal('status')==2)) return true;
            else return false;
        });
        
        // Pay Offer
        $gate->define('pay-offer',function($user,$offer){
            if(($user->id==$offer->violation->author->id)
                AND ($offer->getOriginal('status')==3)
                AND (!$offer->paid)) return true;
            else return false;
        });
        
        // Can compelte order
        $gate->define('complete-offer',function($user,$offer){
            if(($user->id==$offer->author->id)
                AND ($offer->getOriginal('status')==4)) return true;
            else return false;
        });
        
        // Can close the offer
        $gate->define('close-offer',function($user,$offer){
            if(($user->id==$offer->violation->author->id)
                AND ($offer->getOriginal('status')==5)) return true;
            else return false;
        });
    }
}
