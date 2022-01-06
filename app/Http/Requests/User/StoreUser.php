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
            'name' => 'required|string',
            'tel' => 'required|regex:/[0-9]{10}/',
            'dob' => 'required|date_format:d/m/Y',
            'id_card' => 'required|string|min:9|max:12',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'id_role' => 'required|exists:role,id',
            'id_department' => 'required|exists:department,id',
            'id_position' => 'nullable|exists:position,id',
        ];
    }

    public function attributes()
    {
        return [
            'tel' => 'số điện thoại',
            'id_card' => 'chứng minh nhân dân',
            'dob' => 'ngày sinh',
            'id_role' => 'vai trò',
            'id_department' => 'đơn vị',
            'id_position' => 'chức vụ',
        ];
    }
}
