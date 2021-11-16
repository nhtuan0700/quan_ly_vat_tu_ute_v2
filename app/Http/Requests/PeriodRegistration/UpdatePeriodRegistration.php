<?php

namespace App\Http\Requests\PeriodRegistration;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeriodRegistration extends FormRequest
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
            'start_time' => 'date_format:d/m/Y H:i',
            'end_time' => 'required|date_format:d/m/Y H:i|after:start_time'
        ];
    }

    public function messages()
    {
        return [
            'start_time.date_format' => 'Ngày bắt đầu định dạng không hợp lệ',
            'end_time.date_format' => 'Ngày kết thúc định dạng không hợp lệ'
        ];
    }

    public function attributes()
    {
        return [
            'start_time' => 'ngày bắt đầu',
            'end_time' => 'ngày kết thúc',
        ];
    }
}
