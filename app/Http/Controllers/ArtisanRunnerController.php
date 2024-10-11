<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanRunnerController extends Controller
{
    public function migrateFresh()
    {
        Artisan::call('migrate:fresh --seed');

        return response()->json([
            'message' => 'Migration and seeding completed.'
        ]);
    }
    public function link()
    {
        Artisan::call('storage:link');

        return response()->json([
            'message' => 'storage link completed.'
        ]);
    }
    public function clear()
    {
        Artisan::call('dump-autoload ');
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        // php artisan config:cache
        // php artisan config:clear
        // php artisan cache:clear
        return response()->json([
            'message' => ' php artisan config:cache  php artisan config:clear php artisan cache:clear completed.'
        ]);
    }
}
