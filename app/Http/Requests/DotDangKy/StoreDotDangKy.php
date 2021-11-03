<?php

namespace App\Http\Requests\DotDangKy;

use Illuminate\Foundation\Http\FormRequest;

class StoreDotDangKy extends FormRequest
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
            'start_at' => 'required|date_format:d/m/Y H:i|after_or_equal:tomorrow',
            'end_at' => 'required|date_format:d/m/Y H:i|after:start_at'
        ];
    }

    public function messages()
    {
        return [
            'start_at.after_or_equal' => 'Ngày bắt đầu phải sau ngày hôm nay'
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
