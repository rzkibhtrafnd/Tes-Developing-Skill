<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getWidgetStats(): array
    {
        return [
            'totalOmset' => DB::table('table_b')->sum('nominal_transaksi'),
            'totalToko'  => DB::table('table_a')->count(),
            'totalSales' => DB::table('table_d')->count(),
        ];
    }

    public function getAreaPerformanceData(): array
    {
        $performance = DB::table('table_b')
            ->join('table_a', function ($join) {
                $join->on('table_b.kode_toko', '=', 'table_a.kode_toko_baru')
                        ->orOn('table_b.kode_toko', '=', 'table_a.kode_toko_lama');
            })
            ->join('table_c', 'table_c.kode_toko', '=', 'table_a.kode_toko_baru')
            ->select('table_c.area_sales', DB::raw('SUM(table_b.nominal_transaksi) as total_sales'))
            ->groupBy('table_c.area_sales')
            ->get();

        return [
            'labels' => $performance->pluck('area_sales')->map(fn($item) => 'Area ' . strtoupper($item))->toArray(),
            'values' => $performance->pluck('total_sales')->toArray(),
        ];
    }
}