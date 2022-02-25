<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;

class Check_user
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::user()->role) {
            if (Auth::user()->role == env('GOOGLE_ACCOUNT_EMAIL')) {
                return redirect('/admin');
            }
            return redirect('/role');
        }

        return $next($request);
    }
}
