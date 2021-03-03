<?php

namespace App\Http\Middleware;

use Closure;

class VendorAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session()->has('vendor_auth'))
        {
            return redirect('vendor/login');
        }
        return $next($request);
    }
}
