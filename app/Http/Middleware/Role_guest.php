<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Closure;
use Illuminate\Http\Request;

class Role_guest
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
        if (!Auth::user()) {
            return $next($request);
        } else {
            $user = User::where('email', '=',  Auth::user()->email)->first();
            if ($user->role == "clinic") {
                return redirect('/clinic');
            }
            if ($user->role == "customer") {
                return redirect('/customer');
            }
            if (Auth::user()->email == env('GOOGLE_ACCOUNT_EMAIL')) {
                return redirect('/admin');
            }
            if ($user->role == "") {
                return redirect('/role');
            }
        }
    }
}
