<?php

namespace App\Http\Requests\PeriodRegistration;

use Illuminate\Foundation\Http\FormRequest;

class StorePeriodRegistration extends FormRequest
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
            'start_time' => 'required|date_format:d/m/Y H:i|after_or_equal:tomorrow',
            'end_time' => 'required|date_format:d/m/Y H:i|after:start_time'
        ];
    }

    public function messages()
    {
        return [
            'start_time.after_or_equal' => 'Thời gian bắt đầu phải sau ngày hôm nay'
        ];
    }

    public function attributes()
    {
        return [
            'start_time' => 'thời gian bắt đầu',
            'end_time' => 'thời gian kết thúc',
        ];
    }
}
