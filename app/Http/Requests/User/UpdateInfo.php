<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfo extends FormRequest
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
            'name' => 'required',
            'tel' => 'required|regex:/[0-9]{10}/',
            'dob' => 'required',
            'id_card' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'tel' => 'số điện thoại',
            'id_card' => 'chứng minh nhân dân',
            'dob' => 'ngày sinh'
        ];
    }
}
