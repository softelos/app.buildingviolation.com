<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveCommentRequest extends Request
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
            'body'=>'required|min:10|max:255'
        ];
    }
    
    public function messages(){
        return [
            'body.required'=>'The commment you are trying to submit is empty.',
            'body.min'=>'The comment field must be at least 10 characters long.',
            'body.max'=>'The coment field cannot exceed 255 characters.'
        ];
    }
}
