<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // app/Http/Middleware/SetAppLocale.php
    public function handle(Request $request, Closure $next)
    {
        Log::info('API Language Requested: ' . $request->header('Accept-Language') . ' | Set to: ' . app()->getLocale());
        $locale = $request->header('Accept-Language') ?? $request->lang ?? config('app.locale');

        if (in_array($locale, ['ar', 'en'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
