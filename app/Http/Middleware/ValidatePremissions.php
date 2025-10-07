<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ValidatePremissions
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get {id} from URL route
        $id = $request->route('id');

        $rules = [
            "permissions" => ["required", "array", "min:1"],
            "permissions.*" => ['string', "min:3", "max:250"],
            "id" => ['required', 'integer', 'exists:roles,id'], 
        ];

        // Merge the route ID with the request data
        $data = array_merge($request->all(), ['id' => $id]);

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors()
            ], 422);
        }

        return $next($request);
    }
}
