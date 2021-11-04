<?php

namespace App\Http\Requests\ThietBi;

use Illuminate\Foundation\Http\FormRequest;

class StoreThietBi extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'id' => 'unique:thietbi,id',
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
