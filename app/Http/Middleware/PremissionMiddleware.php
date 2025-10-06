<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PremissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$premission): Response
    {

        $user=$request->user();

        if($user->hasPremission($premission)){


            return $next($request);


        }

        return response()->json([
            "status"=>"error",
            "message"=>"user is not authorized to access this resource"
        ],403);

     
    
       



        
    }
}
