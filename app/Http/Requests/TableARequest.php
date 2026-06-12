<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableARequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $tokoId = $this->route('id');

        return [
            'kode_toko_baru' => [
                'required',
                'integer',
                Rule::unique('table_a', 'kode_toko_baru')->ignore($tokoId)
            ],
            'kode_toko_lama' => [
                'nullable',
                'integer',
                Rule::unique('table_a', 'kode_toko_lama')->ignore($tokoId)
            ],
        ];
    }
}