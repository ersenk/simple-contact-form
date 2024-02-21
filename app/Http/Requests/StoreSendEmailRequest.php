<?php

namespace App\Http\Requests;

use App\Models\SendEmail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSendEmailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('send_email_create');
    }

    public function rules()
    {
        return [
            'email_template_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
