<?php

namespace App\Http\Middleware;

use Closure;
use App\Constants\UserTypes;

class Seeker
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
        $request->headers->set('Authorization', $request->headers->get('Auth'));
        $userTypes = UserTypes::SEEKER;
        if (!auth()->user()) {
            return redirect('/login');
        }
        if (auth()->user()->type != $userTypes) {
            return redirect('/login');
        }
        return $next($request);
    }
}
