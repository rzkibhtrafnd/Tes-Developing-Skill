<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableC extends Model
{
    protected $table = 'table_c';
    public $timestamps = false;

    protected $fillable = [
        'kode_toko',
        'area_sales'
    ];

    public function toko()
    {
        return $this->belongsTo(TableA::class, 'kode_toko', 'kode_toko_baru');
    }
}