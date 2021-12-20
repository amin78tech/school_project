<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUpdateExamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'required',
            'time'=>'required',
            'startDate'=>'required',
            'StartTime'=>'required|date_format:H:i:s',
            'EndTime'=>'required|after:StartTime',
        ];
    }
}
