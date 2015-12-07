<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class SaveViolationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Pros can't report a violation
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // For Create and Edit
        $rules=[
            'address2'=>'max:100',
            'city'=>'required|max:60',
            'description'=>'required',
            'zip'=>'required|numeric|digits:5',
            'hearing_date'=>'date|required_if:guilt_admit,0',
            'defense'=>'required_if:guilt_admit,No',
            'contractor'=>'required_if:correction_author,my_employee,contractor,architect_engineer'
        ];
        // For Create
        if(!$this->segment(2)) $rules['address1']='required|unique:violations|max:100';
        else $rules['address1']='required|max:100';   
        
        return $rules;
    }
   
    public function messages(){
        return [
            'address1.required'=>'The Address field is empty. It\'s required to define the location of the violation.',
            'address1.unique'=>'The Address you have entered has already been used to report another violation.',
            'address1.max'=>'The Address field accepts a maximum of 100 characters.',
            'address2.max'=>'The Address 2 field accepts a maxumum of 100 characters.',
            'city.required'=>'The City field is empty. It\'s required to define the location of the violation.',          
            'description.required'=>'The Description field is empty. You need to describe with your words the nature of the violation you are reporting.',
            'zip.required'=>'The Zip field is empty. It\'s required to define the location of the violation.',
            'zip.digits'=>'The Zip code must have 5 digits.',
            'hearing_date.required_if'=>'Since you don\'t admit guilt, you must enter the hearing date you have assigned.',
            'defense.required_if'=>'Since you don\'t admit guilt, you must describe the defense you have prepared for the hearing.',
            'contractor.required_if'=>'Since you have already had the violation corrected, you need to enter the contact details of the person who did it.'            
        ];
    }
}
