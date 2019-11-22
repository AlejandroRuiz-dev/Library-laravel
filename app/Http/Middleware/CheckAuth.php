<?php

namespace App\Http\Middleware;

use App\CustomClasses\Token;
use Closure;
use App\User;
class CheckAuth
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
        $header = $request->header("Authorization");    

        $token = new Token();
        
        if ($header != null) 
        {
            $decodedToken = $token->decode($header);
            //$user_email = $decodedToken->email;
            //$user = User::where('email', $user_email)->first();
        }
        
        if (!empty($decodedToken)) {
            return $next($request);
        }
        return response()->json(['message' => 'Error, no tiene los permisos'], 401);
    }
    
}
