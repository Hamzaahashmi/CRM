<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Employe as Middleware;
use Illuminate\Support\Facades\Auth;

class Employe 
{
    public function handle($request, Closure $next) 
{
    $user = Auth::User();
    if($user->role != 'admin')
    return $next($request);
    return redirect()->back();
}
}