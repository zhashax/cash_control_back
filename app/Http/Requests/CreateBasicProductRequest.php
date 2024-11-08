<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBasicProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'name_of_products' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country' => 'nullable|string',
            'type' => 'nullable|string',
            'brutto' => 'nullable|numeric',
            'netto' => 'nullable|numeric',
            'photo_product' => 'nullable|string',
        ];
    }
}
