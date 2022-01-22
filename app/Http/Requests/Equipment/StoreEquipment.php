<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'id' => 'unique:equipment,id',
            'name' => 'required|string',
            'room' => 'nullable|string',
            'date_grant' => 'nullable|date_format:d/m/Y',
            'date_buy' => 'required|nullable|date_format:d/m/Y'
        ];
    }

    public function attributes()
    {
        return [
            'room' => 'phòng',
            'date_grant' => 'ngày cấp',
            'date_buy' => 'ngày mua'
        ];
    }
}
