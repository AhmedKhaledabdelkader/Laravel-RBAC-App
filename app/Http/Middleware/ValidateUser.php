<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ValidateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $rules=[


            "name"=>['required','string','max:255'],
            "email"=>['required','string','email','max:255','unique:users,email'],
            "password"=>['required','string','min:8','confirmed'],
           

        ];


        $validator=Validator::make($request->all(),$rules);


        if($validator->fails()){
            return response()->json([
                "status"=>422,
                "errors"=>$validator->errors()
            ],422);
        }

        return $next($request);


        
    }
}
