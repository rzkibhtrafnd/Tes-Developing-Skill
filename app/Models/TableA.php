<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableA extends Model
{
    protected $table = 'table_a';
    public $timestamps = false;

    protected $fillable = [
        'kode_toko_baru',
        'kode_toko_lama'
    ];

    public function areaSales()
    {
        return $this->hasOne(TableC::class, 'kode_toko', 'kode_toko_baru');
    }
}