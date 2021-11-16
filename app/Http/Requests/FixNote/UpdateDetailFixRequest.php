<?php

namespace App\Http\Requests\FixNote;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailFixRequest extends FormRequest
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
            'equipments.*.cost' => 'nullable|numeric|min:1000',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        session()->flash('alert-fail', 'Chi phí tối thiếu 1,000 đ');
        parent::failedValidation($validator);
    }
}
