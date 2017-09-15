<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'asset_id' => 'required|integer|unique:servers',
            'price' => 'nullable|integer|min:1',
            'rams' => 'required|array',
            'rams.*.type' => 'required|max:255',
            'rams.*.size' => 'required|integer|min:1'
        ];
    }
}
