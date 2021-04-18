<?php

namespace App\Http\Requests;

use App\Models\PostLocation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_location_create');
    }

    public function rules()
    {
        return [
            'title'     => [
                'string',
                'required',
            ],
            'url'       => [
                'string',
                'required',
            ],
            'driver_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
