<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  

    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est un administrateur
        if (auth()->guard('api')->check() && auth()->guard('api')->user()->role_id===1) {
            return $next($request);
        }
// dd(auth()->guard('api')->user());
        // Rediriger ou retourner une réponse en cas de non-admin
        return response()->json([
            'message'=> 'Vous n\'avez pas les droits d\'acceder à cette ressouce '
        ], 403);
    }
    
}
