<?php

namespace App\Http\Controllers;

use App\Exports\ActivityLogExport;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengaturanController extends Controller
{
    public function activityLogs()
    {
        $activityLogs = ActivityLog::with('user')->latest()->get();
        return view('page.aktivitas_user', compact('activityLogs'));
    }

    public function exportActivityLogs()
    {
        return Excel::download(new ActivityLogExport, 'activity_logs.xlsx');
    }
}
