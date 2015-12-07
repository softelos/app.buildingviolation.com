<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveConditionRequest extends Request
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
            'body'=>'required|min:25|max:255'
        ];
    }
    
    public function messages(){
        return [
            'body.required'=>'The description of the condition cannot be empty.',
            'body.min'=>'The description of the condition must be at least 25 characters.',
            'body.max'=>'The description of the condition cannot exceed 255 charcters.'
        ];
    }
}
