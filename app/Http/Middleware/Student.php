<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        //set last seen value
        $user->last_seen = Carbon::now()->toDateTimeString();
        $user->save();

        if($user->role_id != 2){
            return redirect()->route('login');
        }
        define('GLOBAL_ACCESS',true);

        setRedirectLink($request->getRequestUri());

        return $next($request);
    }
}
