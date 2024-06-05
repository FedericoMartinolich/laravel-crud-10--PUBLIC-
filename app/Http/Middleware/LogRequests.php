<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $date = now()->format('Y-m-d H:i:s');
        $ip = $request->ip();

        DB::table('logs')->insert([
            'ip'=> $ip,
            'date'=> $date,
        ]);
        return $next($request);
    }
}
