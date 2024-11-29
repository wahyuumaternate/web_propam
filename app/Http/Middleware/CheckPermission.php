<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $permissions)
    // {
    //     // Memecah string izin menjadi array jika ada lebih dari satu izin
    //     $permissions = explode(',', $permissions);

    //     // Mengecek apakah pengguna sudah login
    //     if (Auth::check()) {
    //         $user = Auth::user();

    //         // Mengecek apakah pengguna memiliki salah satu dari izin yang diberikan
    //         $hasPermission = false;
    //         foreach ($permissions as $permission) {
    //             if ($user->can($permission)) {
    //                 $hasPermission = true;
    //                 break;
    //             }
    //         }

    //         // Jika pengguna tidak memiliki izin apapun, tampilkan notifikasi error
    //         if (!$hasPermission) {
    //             notify()->error('Anda tidak memiliki izin untuk mengakses halaman ini.');

    //             // Redirect kembali ke halaman sebelumnya
    //             return redirect()->back();
    //         }
    //     } else {
    //         // Jika pengguna belum login, arahkan ke halaman login atau halaman lain yang sesuai
    //         return redirect()->route('login');
    //     }

    //     // Jika pengguna memiliki salah satu izin, lanjutkan ke request selanjutnya
    //     return $next($request);
    // }
    public function handle($request, Closure $next, ...$permissions)
    {
        // Memeriksa apakah pengguna masuk
        if (!Auth::check()) {
            return redirect()->route('dashboard'); // Segera redirect jika tidak login
        }

        // Memeriksa apakah pengguna memiliki salah satu izin yang diberikan
        foreach ($permissions as $permission) {
            if (Auth::user()->can($permission)) {
                return $next($request); // Jika ada yang cocok, lanjutkan ke rute
            }
        }

        // Jika tidak ada izin yang cocok
        abort(403, 'Unauthorized action.');
    }
}
