<?php

namespace App\Rules;

use http\Env\Request;
use Illuminate\Contracts\Validation\Rule;

class notNull implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        //
    }
    public function message()
    {
        return 'فیلد ها نباید خالی باشد';
    }
}
