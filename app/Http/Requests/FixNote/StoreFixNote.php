<?php

namespace App\Http\Requests\FixNote;

use Illuminate\Foundation\Http\FormRequest;

class StoreFixNote extends FormRequest
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
            'equipments' => 'required',
            'equipments.*' => 'string|nullable'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        session()->flash('alert-fail', 'Danh sách thiết bị yêu cầu không hợp lệ!');
        parent::failedValidation($validator);
    }
}