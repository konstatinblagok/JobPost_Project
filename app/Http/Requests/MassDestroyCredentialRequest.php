<?php

namespace App\Http\Requests;

use App\Models\Credential;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCredentialRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('credential_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:credentials,id',
        ];
    }
}
