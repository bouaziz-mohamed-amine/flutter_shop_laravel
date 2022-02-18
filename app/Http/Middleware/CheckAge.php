<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,int $age)
    {


        if ($age <= 2) {

            //return  redirect()->route('roles.index');
            return response(["messsage"=> "forbidden"],403);

        }

        return $next($request);
    }
}
