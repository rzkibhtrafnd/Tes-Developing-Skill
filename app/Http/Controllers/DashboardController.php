<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function __invoke()
    {
        $stats = $this->dashboardService->getWidgetStats();
        $chartData = $this->dashboardService->getAreaPerformanceData();

        return view('dashboard', [
            'totalOmset'  => $stats['totalOmset'],
            'totalToko'   => $stats['totalToko'],
            'totalSales'  => $stats['totalSales'],
            'areaLabels'  => $chartData['labels'],
            'areaValues'  => $chartData['values'],
        ]);
    }
}