<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "name"=>"required",
            "startdate"=>"required",
            "enddate"=>"required",
            "optionTeacher"=>"required",
            "optionStudent"=>"required"
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>"نام الزامی می باشد",
            "startdate.required"=>"تاریخ شروع الزامی می باشد",
            "enddate.required"=>"تاریخ پایان الزامی می باشد",
            "optionTeacher.required"=>"انتخاب معلم الزامی می باشد",
            "optionStudent.required"=>"انتخاب دانش آموزش الزامی می باشد",
        ];
    }
}
