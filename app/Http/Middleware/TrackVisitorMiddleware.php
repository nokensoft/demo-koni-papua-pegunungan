<?php

namespace App\Http\Middleware;

use App\Models\KunjunganSitus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // insertOrIgnore: satu baris per IP per hari dijaga oleh unique index
        // (ip_address, tanggal). firstOrCreate gagal di SQLite karena cast 'date'
        // menyimpan "Y-m-d 00:00:00" sehingga lookup "Y-m-d" tidak pernah cocok.
        KunjunganSitus::query()->insertOrIgnore([
            'ip_address' => $request->ip(),
            'tanggal'    => today(),
            'url'        => mb_substr($request->path(), 0, 255),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
            'created_at' => now(),
        ]);

        return $next($request);
    }
}
