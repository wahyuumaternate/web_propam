<?php

namespace App\Exports;

use App\Models\ActivityLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityLogExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Eager load the user relationship and select the necessary columns
        return ActivityLog::with('user')
            ->get()
            ->map(function ($log) {
                return [
                    'user' => $log->user->name ?? 'System',
                    'action' => $log->action,
                    'description' => $log->description,
                    'date' => $log->created_at->format('Y-m-d H:i:s'),
                ];
            });
    }

    /**
     * Define the headings for the Excel file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'User',
            'Action',
            'Description',
            'Date',
        ];
    }
}
