<?php

namespace App\Http\Middleware;

use Closure;

class authVerify
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

        if(empty($request->type_login)){
            return redirect("/login");
        } 

        return $next($request);
    }
}
