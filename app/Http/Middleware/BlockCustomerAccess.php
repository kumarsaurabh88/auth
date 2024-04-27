<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockCustomerAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'customer') {
            return redirect()->route('home')->with('error', 'Access denied for customers.');
        }

        return $next($request);
    }
}
