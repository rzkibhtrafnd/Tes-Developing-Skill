<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableDRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $salesId = $this->route('id');

        return [
            'kode_sales' => [
                'required',
                'string',
                'max:255',
                Rule::unique('table_d', 'kode_sales')->ignore($salesId)
            ],
            'nama_sales' => 'required|string|max:20',
        ];
    }
}