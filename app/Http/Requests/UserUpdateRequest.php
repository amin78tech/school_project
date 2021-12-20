<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "name"=>"required",
            "family"=>"required",
            "username"=>"required|min:3",
            "email"=>"required",
            "password"=>"nullable",
            "option"=>"required",
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>"نام الزامی می باشد",
            "family.required"=>"فامیلی الزامی می باشد",
            "username.required"=>"نام کاربری الزامی می باشد",
            "username.min"=>"نام کاربری می بایست حداقل سه کارکتر باشد",
            "email.required"=>"ایمیل الزامی می باشد",
//            "password.required"=>"نام کاربری می بایست حداقل سه کارکتر باشد",
            "password.min"=>"رمز عبور می بایست حداقل 8 کارکتر باشد",
        ];
    }
}
