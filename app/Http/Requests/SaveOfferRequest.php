<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveOfferRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'introduction'=>'required|min:60|max:150',
            'approach'=>'required|min:150|max:1000',
            'cost'=>'required|integer|digits_between:2,6|min:10',
            'days'=>'required|integer|digits_between:1,3|min:1'
        ];
    }
    
    
    public function messages(){
        return [
            'introduction.required'=>'You must enter an introduction before you can submit your offer.',
            'introduction.min'=>'Your introduction must be at least 60 characters long.',
            'introduction.max'=>'The introduction cannot have more than 150 characters.',
            'approach.required'=>'You must describe your approach to solving the violation before you can submit your offer.',
            'approach.min'=>'Your approach to solve this violation must be at least 150 characters long.',
            'approach.max'=>'The approach field cannot have more than 1000 characters.',
            'cost.required'=>'You must enter an estimated cost to solve this violation.',
            'days.required'=>'You must enter an estimated amount of days that that will take to solve this violation.',
            'cost.integer'=>'The cost must be a number.',
            'days.integer'=>'The amount of days must be a number.',
            'cost.min'=>'The estimated cost must be at least $10.',
            'days.min'=>'The estimated number of days that will take to solve this violation must be at least 1.'
            
            

        ];
    }
}
