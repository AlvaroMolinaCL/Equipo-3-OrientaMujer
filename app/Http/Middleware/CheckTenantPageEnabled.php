<?php

namespace App\Http\Middleware;

use Closure;

class CheckTenantPageEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $pageKey)
    {
        if (!tenant()) {
            abort(404);
        }

        $enabled = \App\Models\TenantPage::where('tenant_id', tenant()->id)
            ->where('page_key', $pageKey)
            ->where('is_enabled', true)
            ->exists();

        if (!$enabled) {
            abort(404);
        }

        return $next($request);
    }
}
