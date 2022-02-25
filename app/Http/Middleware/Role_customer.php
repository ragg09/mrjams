<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Closure;
use Illuminate\Http\Request;

class Role_customer
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
        if(Auth::user()->role != "customer"){
            //abort(403);
            return redirect()->back();
        }
        
        return $next($request);
    }
}
