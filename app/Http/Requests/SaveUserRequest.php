<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveUserRequest extends Request
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
            'username'=>'unique:users|min:8|max:60',
            'email'=>'unique:users|max:254',
            'firstname'=>'max:255',
            'lastname'=>'max:255',
            'address1'=>'max:100',
            'address2'=>'max:100',
            'city'=>'max:35',
            'zip'=>'numeric|digits:5',
            'phone'=>['regex:/^(\({1}\d{3}\){1}|\d{3})(\s|-|.)\d{3}(\s|-|.)\d{4}$/'],
            'paypal'=>'max:254',
            'license_number'=>'required_if:licensed,Yes',
            'password'=>'same:password_confirmation|max:60|min:8',
        ];
    }
    
    public function messages(){
        return [
            'username.unique'=>'The Username you have chosed is already taken by another user.',            
            'email.unique'=>'The Email address you have entered is already taken by another user.',
            'address1.max'=>'The Address field accepts a maximum of 100 characters.',
            'address2.max'=>'The Address 2 field accepts a maximum of 100 characters.',
            'zip.digits'=>'The Zip code must have 5 digits.',       
            'phone.regex'=>'The phone number you have entered is not a valid US phone number.',
            'paypal.max'=>'Your PayPal account cannot have more than 254 characters.',                 
            'license_number.required_if'=>'Since you are licensed, you need to enter your license number.',
            'password.same'=>'The password you entered doesn\'t match the one you entered in the confirmation field.'
        ];
    }
}
