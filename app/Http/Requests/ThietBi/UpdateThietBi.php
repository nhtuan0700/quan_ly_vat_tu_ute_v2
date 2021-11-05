<?php

namespace App\Http\Requests\ThietBi;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThietBi extends FormRequest
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
            'name' => 'required|string',
            'phong' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'phong' => 'phòng'
        ];
    }
}
