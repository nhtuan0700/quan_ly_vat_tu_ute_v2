<?php

namespace App\Http\Requests\DotDangKy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDotDangKy extends FormRequest
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
            'start_at' => 'date_format:d/m/Y H:i',
            'end_at' => 'required|date_format:d/m/Y H:i|after:start_at'
        ];
    }

    public function messages()
    {
        return [
            'start_at.date_format' => 'Ngày bắt đầu định dạng không hợp lệ',
            'end_at.date_format' => 'Ngày kết thúc định dạng không hợp lệ'
        ];
    }

    public function attributes()
    {
        return [
            'start_at' => 'ngày bắt đầu',
            'end_at' => 'ngày kết thúc',
        ];
    }
}
