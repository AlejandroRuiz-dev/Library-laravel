<?php

namespace App\Http\Middleware;

use APP\CustomClasses\Token;
use Closure;

class CheckAdmin
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
        $found = false;

        $header = $request->header("Authorization");    

        $token = new Token();

        $decodedToken = $token->decode($header);
        
        $users = User::all();
        foreach ($users as $key => $user) {
            if ($decodedToken->email = $user->email) {
                $found = true;
            }
        }

        if ($found = true) {
            return $next($request);
        }
        else
        {
            //error 404
        }
        
    }
}
