<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
        return  [
            'name' => 'required',
            'tel' => 'required|regex:/[0-9]{10}/',
            'dob' => 'required|date_format:d/m/Y',
            'cmnd' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'id_role' => 'required|exists:role,id',
            'id_donvi' => 'required|exists:donvi,id'
        ];
    }

    public function attributes()
    {
        return [
            'tel' => 'số điện thoại',
            'cmnd' => 'chứng minh nhân dân',
            'dob' => 'ngày sinh',
            'id_role' => 'vai trò',
            'id_donvi' => 'đơn vị'
        ];
    }
}
