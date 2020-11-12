<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
// IIluminate\Support\Facades\Auth
class CheckAdmin
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
      if(Auth::check()){
        if(Auth::user()->role_name == 'ADMIN'){
          return $next($request);
        }
        return redirect('admin/dashboard');
      }
      return redirect('login');
    }
}
