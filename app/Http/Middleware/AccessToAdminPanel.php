<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessToAdminPanel
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->admin_panel) {
            return $next($request);
        } else {
            return redirect()->route('books.index');
        }
    }
}
