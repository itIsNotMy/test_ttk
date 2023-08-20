<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateBook
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->id === $request->route()->parameter('book')->user_id) {
            return $next($request);
        } else {
            return redirect()->route('books.index');
        }
    }
}
