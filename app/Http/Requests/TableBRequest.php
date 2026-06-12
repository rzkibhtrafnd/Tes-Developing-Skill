<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableBRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'kode_toko' => 'required|integer|exists:table_a,kode_toko_baru',
            'nominal_transaksi' => 'required|numeric|min:0',
        ];
    }
}