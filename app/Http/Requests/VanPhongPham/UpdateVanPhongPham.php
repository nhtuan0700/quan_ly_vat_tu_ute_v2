<?php

namespace App\Http\Requests\VanPhongPham;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVanPhongPham extends FormRequest
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
            'name' => 'required|unique:vanphongpham,name,'. $this->route('id'),
            'dvt' => 'required|string',
            'hanmuc_tb' => 'required|integer|min:0',
            'id_danhmuc' => 'required|exists:danhmuc,id'
        ];
    }

    public function attributes()
    {
        return [
            'dvt' => 'đơn vị tính',
            'hanmuc_tb' => 'hạn mức trung bình',
            'id_danhmuc' => 'danh mục',
        ];
    }
}
