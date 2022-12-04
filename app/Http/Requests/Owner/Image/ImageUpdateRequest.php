<?php

namespace App\Http\Requests\Owner\Image;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
            'owner_id' => 'required|numeric',
            'title' => 'nullable|string|',
            'file' => 'required|mimes:jpg,bmp,png|',
        ];
    }
}


