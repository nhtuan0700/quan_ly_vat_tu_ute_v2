<?php

namespace App\Http\Requests\DangKyVPP;

use Illuminate\Foundation\Http\FormRequest;

class SaveDangKyVPP extends FormRequest
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
            // 'vanphongpham' => 'required',
            'vanphongpham.*' => 'integer|min:1'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        session()->flash('alert-fail', 'Danh sách văn phòng phẩm không hợp lệ!');
        parent::failedValidation($validator);
    }
}
