<?php
declare(strict_types=1);

namespace Encore\RedisManager\Http\Middleware;

class Permission
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return \Illuminate\Http\Response|null
     */
    public function handle($request, $next)
    {
        return config('redis-manager.readonly', true) ? abort(403): $next($request);
    }
}
