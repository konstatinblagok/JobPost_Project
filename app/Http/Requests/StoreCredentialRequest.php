<?php

namespace App\Http\Requests;

use App\Models\Credential;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCredentialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('credential_create');
    }

    public function rules()
    {
        return [
            'username'  => [
                'string',
                'required',
                'unique:credentials',
            ],
            'title'     => [
                'string',
                'required',
            ],
            'drivers.*' => [
                'integer',
            ],
            'drivers'   => [
                'required',
                'array',
            ],
        ];
    }
}
