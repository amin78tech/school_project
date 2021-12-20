<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAddExamRequest extends FormRequest
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
            'startTime'=>'required|date_format:H:i',
            'endTime'=>'required|date_format:H:i|after:startTime',
        ];
    }
}
