<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'merchant_id' => 'numeric',
            // 'integration' => 'required|in:TWILIO,MAILGUN,SLACK,SNAPENGAGE',

            'uuid'          => 'required|min:36|max:36',
            'account'       => 'required|min:22|max:22',
            'personal_code' => 'required|min:11|max:11',
            'name'          => 'required|min:4|max:32',
            'surname'       => 'required|min:4|max:32',
            'value'         => 'required',
        ];
    }
}