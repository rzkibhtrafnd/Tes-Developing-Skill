<?php

namespace App\Imports;

use App\Models\TableB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class TransaksiImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (empty($row['kode_toko']) || empty($row['nominal_transaksi'])) {
            return null;
        }

        return new TableB([
            'kode_toko' => $row['kode_toko'],
            'nominal_transaksi' => $row['nominal_transaksi'],
        ]);
    }
}
