<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
class isActive
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
        if(Auth::check())
        {
            // If current session id is not same with last_session column
            if(Auth::user()->last_session != Session::getId())
            {
                // do logout
                Auth::logout();

                // Redirecto login page
                return Redirect::to('login');
            }
        }
        if (auth()->check()) {
			if(auth()->user()->status_id == 2){
				auth()->logout();
				
				$message = __('You are not active yet. Please contact administrator.');
				return redirect()->back()->withMessage($message);
			}
        }
		
        return $next($request);
    }
}
