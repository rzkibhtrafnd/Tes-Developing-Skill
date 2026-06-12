<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableCRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $areaId = $this->route('id');

        return [
            'kode_toko' => [
                'required',
                'integer',
                'exists:table_a,kode_toko_baru',
                Rule::unique('table_c', 'kode_toko')->ignore($areaId)
            ],
            'area_sales' => 'required|string|max:10|in:A,B,a,b',
        ];
    }
}