<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
            "option"=>"required"
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'لطفا ایمیل را وارد نمایید',
            'password.required' => 'لطفا رمزعبور رو وارد نمایید'
        ];
    }

}
