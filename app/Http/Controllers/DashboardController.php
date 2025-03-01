<?php

namespace App\Http\Controllers;

use App\Models\DaftarKasus;
use App\Models\Kategori;
use App\Models\Pelanggaran;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Get selected year or default to current year
    //     $selectedYear = $request->input('year', date('Y'));
    //     if (Auth::user()->can('lihat_semua_kasus')) {
    //         $totalKasus = DaftarKasus::all()->count();
    //         // Fetch data for violations per year (monthly data)
    //         $pelanggaranData = DaftarKasus::selectRaw('pelanggaran_id, MONTH(created_at) as month, COUNT(*) as count')
    //             ->whereNotNull('pelanggaran_id')
    //             ->whereYear('created_at', $selectedYear) // Filter by selected year
    //             ->groupBy('pelanggaran_id', 'month')
    //             ->orderBy('month')
    //             ->get()
    //             ->groupBy('pelanggaran_id');
    //         // Fetch and prepare data for cases by status
    //         $statusData = DaftarKasus::selectRaw('status_id, COUNT(*) as count')
    //         ->groupBy('status_id')
    //         ->whereYear('created_at', $selectedYear) // Filter by selected year
    //         ->get();

    //     }else{
    //         $totalKasus = DaftarKasus::where('user_id',Auth::user()->id)->count();
    //         // Fetch data for violations per year (monthly data)
    //         $pelanggaranData = DaftarKasus::selectRaw('pelanggaran_id, MONTH(created_at) as month, COUNT(*) as count')
    //         ->where('user_id',Auth::user()->id)
    //             ->whereNotNull('pelanggaran_id')
    //             ->whereYear('created_at', $selectedYear) // Filter by selected year
    //             ->groupBy('pelanggaran_id', 'month')
    //             ->orderBy('month')
    //             ->get()
    //             ->groupBy('pelanggaran_id');

    //         // Fetch and prepare data for cases by status
    //         $statusData = DaftarKasus::selectRaw('status_id, COUNT(*) as count')
    //         ->where('user_id',Auth::user()->id)
    //         ->groupBy('status_id')
    //         ->whereYear('created_at', $selectedYear) // Filter by selected year
    //         ->get();
    //     }
    
    //     // Load pelanggaran names
    //     $pelanggaranNames = Pelanggaran::whereIn('id', $pelanggaranData->keys())->pluck('nama_pelanggaran', 'id');
    
    //     // Prepare chart data for violations
    //     $chartData = [];
    //     $months = range(1, 12); // Months of the year
    
    //     foreach ($pelanggaranData as $pelanggaranId => $data) {
    //         $monthlyData = array_fill_keys($months, 0);
    //         foreach ($data as $item) {
    //             $monthlyData[$item->month] = $item->count;
    //         }
    //         $chartData[] = [
    //             'name' => $pelanggaranNames[$pelanggaranId] ?? 'Unknown',
    //             'data' => array_values($monthlyData)
    //         ];
    //     }
    
        
    //     $statusNames = Status::whereIn('id', $statusData->pluck('status_id'))->pluck('nama_status', 'id');
    
    //     $statusChartData = [
    //         'labels' => [],
    //         'counts' => []
    //     ];
    
    //     foreach ($statusData as $item) {
    //         $statusChartData['labels'][] = $statusNames[$item->status_id] ?? 'Unknown';
    //         $statusChartData['counts'][] = $item->count;
    //     }
    
    //     // Get available years for the dropdown filter
    //     $availableYears = DaftarKasus::selectRaw('YEAR(created_at) as year')
    //         ->distinct()
    //         ->orderBy('year', 'desc')
    //         ->pluck('year');
    
    //         $query = DaftarKasus::select('kategori.nama_kategori as kategori_nama', 'kasus.kategori_id', DB::raw('COUNT(*) as total'))
    //             ->join('kategori', 'kasus.kategori_id', '=', 'kategori.id')
    //             ->groupBy('kasus.kategori_id', 'kategori.nama_kategori')
    //             ->orderBy('total', 'desc');

    //         // Filter berdasarkan waktu
    //         if ($request->filter == 'month') {
    //             $query->whereMonth('kasus.created_at', Carbon::now()->month)
    //                 ->whereYear('kasus.created_at', Carbon::now()->year);
    //         } elseif ($request->filter == 'year') {
    //             $query->whereYear('kasus.created_at', Carbon::now()->year);
    //         }

    //         $topKasusCategories = $query->take(10)->get(); // Mengambil 10 data teratas
        
            

    //     return view('dashboard', [
    //         'chartData' => $chartData,
    //         'statusChartData' => $statusChartData,
    //         'months' => $months,
    //         'selectedYear' => $selectedYear,
    //         'availableYears' => $availableYears,
    //         'topKasusCategories'=>$topKasusCategories,
    //         'totalKasus'=> $totalKasus,
    //     ]);
    // }



    public function index(Request $request)
    {
        // Get selected year or default to current year
        $selectedYear = $request->input('year', date('Y'));
        
        // Set default filter to 'year' if not specified
        $filter = $request->input('filter', 'year');
        
        if (Auth::user()->can('lihat_semua_kasus')) {
            $totalKasus = DaftarKasus::all()->count();
            // Fetch data for categories per year (monthly data)
            $kategoriData = DaftarKasus::selectRaw('kategori_id, MONTH(created_at) as month, COUNT(*) as count')
                ->whereNotNull('kategori_id')
                ->whereYear('created_at', $selectedYear) // Filter by selected year
                ->groupBy('kategori_id', 'month')
                ->orderBy('month')
                ->get()
                ->groupBy('kategori_id');
            // Fetch and prepare data for cases by status
            $statusData = DaftarKasus::selectRaw('status_id, COUNT(*) as count')
            ->groupBy('status_id')
            ->whereYear('created_at', $selectedYear) // Filter by selected year
            ->get();
    
        } else {
            $totalKasus = DaftarKasus::where('user_id', Auth::user()->id)->count();
            // Fetch data for categories per year (monthly data)
            $kategoriData = DaftarKasus::selectRaw('kategori_id, MONTH(created_at) as month, COUNT(*) as count')
            ->where('user_id', Auth::user()->id)
                ->whereNotNull('kategori_id')
                ->whereYear('created_at', $selectedYear) // Filter by selected year
                ->groupBy('kategori_id', 'month')
                ->orderBy('month')
                ->get()
                ->groupBy('kategori_id');
    
            // Fetch and prepare data for cases by status
            $statusData = DaftarKasus::selectRaw('status_id, COUNT(*) as count')
            ->where('user_id', Auth::user()->id)
            ->groupBy('status_id')
            ->whereYear('created_at', $selectedYear) // Filter by selected year
            ->get();
        }
    
        // Load kategori names
        $kategoriNames = Kategori::whereIn('id', $kategoriData->keys())->pluck('nama_kategori', 'id');
    
        // Prepare chart data for categories
        $chartData = [];
        $months = range(1, 12); // Months of the year
    
        foreach ($kategoriData as $kategoriId => $data) {
            $monthlyData = array_fill_keys($months, 0);
            foreach ($data as $item) {
                $monthlyData[$item->month] = $item->count;
            }
            $chartData[] = [
                'name' => $kategoriNames[$kategoriId] ?? 'Unknown',
                'data' => array_values($monthlyData)
            ];
        }
    
        
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
    
        $query = DaftarKasus::select('kategori.nama_kategori as kategori_nama', 'kasus.kategori_id', DB::raw('COUNT(*) as total'))
            ->join('kategori', 'kasus.kategori_id', '=', 'kategori.id')
            ->groupBy('kasus.kategori_id', 'kategori.nama_kategori')
            ->orderBy('total', 'desc');
    
        // Filter berdasarkan waktu
        if ($filter == 'month') {
            $query->whereMonth('kasus.created_at', Carbon::now()->month)
                ->whereYear('kasus.created_at', Carbon::now()->year);
        } elseif ($filter == 'year') {
            $query->whereYear('kasus.created_at', Carbon::now()->year);
        }
    
        $topKasusCategories = $query->take(10)->get(); // Mengambil 10 data teratas
        
        return view('dashboard', [
            'chartData' => $chartData,
            'statusChartData' => $statusChartData,
            'months' => $months,
            'selectedYear' => $selectedYear,
            'availableYears' => $availableYears,
            'topKasusCategories' => $topKasusCategories,
            'totalKasus' => $totalKasus,
            'filter' => $filter, // Pass the filter to the view
        ]);
    }


}
