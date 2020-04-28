<?php

namespace App\Http\Middleware;

use Closure;

class CheckMember
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $serverAccount = $request->route()->parameter('serverAccount');

        if (!$request->user()->getServerAccount($serverAccount->id)) {
            return redirect('accounts');
        }

        return $next($request);
    }
}
