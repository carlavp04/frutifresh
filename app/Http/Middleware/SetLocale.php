<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {

            App::setLocale(auth()->user()->idioma ?? 'es');

        } else {

            App::setLocale(session('locale', 'es'));

        }

        return $next($request);
    }
}