<?php

namespace App\Http\Requests\Owner\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'id' => 'required|numeric',
            'shop_id' => 'required|numeric',
            'is_selling' => 'required|numeric',
            'secondary_category_id' => 'required|numeric',
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
            'information' => 'nullable|string',
            'image_first' => 'nullable|numeric',
            'image_second' => 'nullable|numeric',
            'image_third' => 'nullable|numeric',
            'image_fourth' => 'nullable|numeric',
            'type' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
        ];
    }
}


