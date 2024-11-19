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
    public function handle(Request $request, Closure $next, $permission)
    {
        // Mengecek apakah pengguna sudah memiliki permission yang diperlukan
        if (Auth::check() && !Auth::user()->can($permission)) {
            // Menampilkan notifikasi error menggunakan Notify
            notify()->error('Anda tidak memiliki izin untuk mengakses halaman ini.');

            // Redirect kembali ke halaman sebelumnya
            return redirect()->back();
        }

        // Jika pengguna memiliki permission, lanjutkan ke request selanjutnya
        return $next($request);
    }
}
