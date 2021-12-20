<?php

namespace App\Http\Requests;

use App\Rules\notNull;
use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
class FormTestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title'=>'required|min:10',
            'option'=> 'required',
            'score'=>'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'عنوان سوال الزامی می باشد',
            'title.min'=>'حداقل عنوان ده کارکتر می باشد',
            'option.required'=>'آپشن الزامی می باشد',
        ];
    }
}
