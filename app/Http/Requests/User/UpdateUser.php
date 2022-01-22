<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'id_role' => 'required|exists:role,id',
            'id_department' => 'required|exists:department,id',
            'id_position' => 'required|exists:position,id',
        ];
    }

    public function attributes()
    {
        return [
            'tel' => 'số điện thoại',
            'id_role' => 'vai trò',
            'dob' => 'ngày sinh',
            'id_card' => 'chứng minh nhân dân',
            'id_department' => 'đơn vị',
            'id_position' => 'chức vụ',
        ];
    }
}

