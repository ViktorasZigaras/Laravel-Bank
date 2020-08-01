<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'value' => 'required|integer|min:0',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'gte:value' => 'Value can't be greater than existing value.',
    //     ];
    // }
}