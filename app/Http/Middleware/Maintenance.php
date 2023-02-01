<?php

namespace App\Http\Middleware;

class Maintenance{

    public function handle($request, $next){
        if(getenv('MAINTENANCE')=='true'){
            throw new \Exception("Estamos em Manutenção! Volte mais tarde.",200);
        }
        return $next($request);
    }
}