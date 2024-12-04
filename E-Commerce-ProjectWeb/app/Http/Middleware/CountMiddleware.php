<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Favorite;

class CountMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            view()->share('cartCount', Cart::where('user_id', Auth::id())->count());
            view()->share('favoriteCount', Favorite::where('user_id', Auth::id())->count());
        }
        return $next($request);
    }
}
