<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;

class ResolveTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->getHost();
        $tenant = Tenant::where('domain', $domain)->first();

        if (!$tenant) {
            abort(404);
        }

        if (auth()->check() && (int)auth()->user()->tenant_id !== $tenant->id) {
            abort(403);
        }
        app()->instance('currentTenant', $tenant);

        return $next($request);
    }
}
