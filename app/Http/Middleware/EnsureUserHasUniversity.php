<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasUniversity
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()->university) {
            return redirect()->route('profile.edit')->with('success', 'Please set your university before accessing community features.');
        }

        return $next($request);
    }
}
