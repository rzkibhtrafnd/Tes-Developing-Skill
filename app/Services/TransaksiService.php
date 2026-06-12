<?php

namespace App\Services;

use App\Models\TableB;
use App\Models\TableA;
use Exception;

class TransaksiService
{
    public function getAllTransaksi()
    {
        return TableB::all();
    }

    public function getPaginatedTransaksi($perPage = 10)
    {
        return TableB::paginate($perPage);
    }

    public function getTransaksiById($id)
    {
        return TableB::findOrFail($id);
    }

    public function storeTransaksi(array $data)
    {
        $tokoValid = TableA::where('kode_toko_baru', $data['kode_toko'])
                            ->orWhere('kode_toko_lama', $data['kode_toko'])
                            ->exists();

        if (!$tokoValid) {
            throw new Exception("Kode Toko tidak terdaftar di sistem master data (Table A).");
        }

        return TableB::create($data);
    }

    public function updateTransaksi($id, array $data)
    {
        $tokoValid = TableA::where('kode_toko_baru', $data['kode_toko'])
                            ->orWhere('kode_toko_lama', $data['kode_toko'])
                            ->exists();

        if (!$tokoValid) {
            throw new Exception("Kode Toko tidak terdaftar di sistem master data (Table A).");
        }

        $transaksi = $this->getTransaksiById($id);
        $transaksi->update($data);
        return $transaksi;
    }

    public function deleteTransaksi($id)
    {
        $transaksi = $this->getTransaksiById($id);
        return $transaksi->delete();
    }

    public function importFromExcel(array $rows)
    {
        foreach ($rows as $row) {
            if (isset($row['kode_toko']) && isset($row['nominal_transaksi'])) {
                $this->storeTransaksi([
                    'kode_toko' => $row['kode_toko'],
                    'nominal_transaksi' => $row['nominal_transaksi']
                ]);
            }
        }
    }
}