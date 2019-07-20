<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        //validar que el usuario sea administrador
        if (auth()->user()->is_admin) {
           return $next($request);//continua con la ejecucion normal
        }else{
            //no es administrador, se redirecciona al inicio
            return redirect('/');
        }
        
    }
}
