<?php

namespace App\Http\Requests\Stationery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStationery extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('stationery', 'name')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ],
            'unit' => 'required|string',
            'limit_avg' => 'required|integer|min:0',
            // 'id_category' => 'required|exists:category,id'
        ];
    }

    public function attributes()
    {
        return [
            'unit' => 'đơn vị tính',
            'limit_avg' => 'hạn mức trung bình',
            // 'id_category' => 'danh mục',
        ];
    }
}
