<?php

namespace App\Http\Controllers;

use App\Models\DaftarKasus;
use App\Models\Pelanggaran;
use App\Models\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get selected year or default to current year
        $selectedYear = $request->input('year', date('Y'));
    
        // Fetch data for violations per year (monthly data)
        $pelanggaranData = DaftarKasus::selectRaw('pelanggaran_id, MONTH(created_at) as month, COUNT(*) as count')
            ->whereNotNull('pelanggaran_id')
            ->whereYear('created_at', $selectedYear) // Filter by selected year
            ->groupBy('pelanggaran_id', 'month')
            ->orderBy('month')
            ->get()
            ->groupBy('pelanggaran_id');
    
        // Load pelanggaran names
        $pelanggaranNames = Pelanggaran::whereIn('id', $pelanggaranData->keys())->pluck('nama_pelanggaran', 'id');
    
        // Prepare chart data for violations
        $chartData = [];
        $months = range(1, 12); // Months of the year
    
        foreach ($pelanggaranData as $pelanggaranId => $data) {
            $monthlyData = array_fill_keys($months, 0);
            foreach ($data as $item) {
                $monthlyData[$item->month] = $item->count;
            }
            $chartData[] = [
                'name' => $pelanggaranNames[$pelanggaranId] ?? 'Unknown',
                'data' => array_values($monthlyData)
            ];
        }
    
        // Fetch and prepare data for cases by status
        $statusData = DaftarKasus::selectRaw('status_id, COUNT(*) as count')
            ->groupBy('status_id')
            ->whereYear('created_at', $selectedYear) // Filter by selected year
            ->get();
        $statusNames = Status::whereIn('id', $statusData->pluck('status_id'))->pluck('nama_status', 'id');
    
        $statusChartData = [
            'labels' => [],
            'counts' => []
        ];
    
        foreach ($statusData as $item) {
            $statusChartData['labels'][] = $statusNames[$item->status_id] ?? 'Unknown';
            $statusChartData['counts'][] = $item->count;
        }
    
        // Get available years for the dropdown filter
        $availableYears = DaftarKasus::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    
        return view('dashboard', [
            'chartData' => $chartData,
            'statusChartData' => $statusChartData,
            'months' => $months,
            'selectedYear' => $selectedYear,
            'availableYears' => $availableYears
        ]);
    }
    public function index2(Request $request)
{
     // Get the selected year or default to the current year
     $selectedYear = $request->input('year', date('Y'));

     // Fetch data for the selected year grouped by month
     $pelanggaranData = DaftarKasus::selectRaw('pelanggaran_id, MONTH(created_at) as month, COUNT(*) as count')
         ->whereNotNull('pelanggaran_id')
         ->whereYear('created_at', $selectedYear) // Filter by selected year
         ->groupBy('pelanggaran_id', 'month')
         ->orderBy('month')
         ->get()
         ->groupBy('pelanggaran_id');
 
     // Load pelanggaran names
     $pelanggaranNames = Pelanggaran::whereIn('id', $pelanggaranData->keys())->pluck('nama_pelanggaran', 'id');
 
     // Organize data for the chart
     $chartData = [];
     $months = range(1, 12); // Months of the year
 
     foreach ($pelanggaranData as $pelanggaranId => $data) {
         $monthlyData = array_fill_keys($months, 0);
         foreach ($data as $item) {
             $monthlyData[$item->month] = $item->count;
         }
         $chartData[] = [
             'name' => $pelanggaranNames[$pelanggaranId] ?? 'Unknown',
             'data' => array_values($monthlyData)
         ];
     }
 
     // Get available years for the dropdown filter
     $availableYears = DaftarKasus::selectRaw('YEAR(created_at) as year')
         ->distinct()
         ->orderBy('year', 'desc')
         ->pluck('year');
 
     return view('dashboard', [
         'chartData' => $chartData,
         'months' => $months,
         'selectedYear' => $selectedYear,
         'availableYears' => $availableYears
     ]);
}
}
