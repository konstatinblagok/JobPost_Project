<?php

namespace App\Http\Requests;

use App\Models\PostLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPostLocationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('post_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:post_locations,id',
        ];
    }
}
