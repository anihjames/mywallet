<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerFormRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'=> 'required|string|email|unique:users|max:255',
            'mobile_number'=> 'required|digits:11',
            'password'=> 'required|alpha_num|confirmed|min:6'
        ];
    }
}
