<?php

namespace App\Exports;

use App\Models\TableB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return TableB::all();
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Kode Toko',
            'Nominal Transaksi (Rp)'
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->kode_toko,
            $transaksi->nominal_transaksi,
        ];
    }
}