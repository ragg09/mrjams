<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Closure;
use Illuminate\Http\Request;

class Role_clinic
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
        if(Auth::user()->role != "clinic"){
            //abort(403);
            return redirect()->back();
        }
        
        return $next($request);
    }
}
