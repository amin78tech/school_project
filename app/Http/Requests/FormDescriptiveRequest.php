<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDescriptiveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'required|min:10',
            'score'=>'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'عنوان سوال الزامی می باشد',
            'title.min'=>'حداقل عنوان ده کارکتر می باشد'
        ];
    }
}
