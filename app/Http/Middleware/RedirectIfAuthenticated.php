<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Si no se especifican guards, Laravel usa ['web'] por defecto.
        // Aquí, si los guards están vacíos, los establecemos explícitamente a ['web'].
        
        $guards = empty($guards) ? ['web'] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Si el guard actualmente autenticado es 'admin', redirige a /admin
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard'); 
                }

                // Para cualquier otro guard (incluido 'web'), redirige al /dashboard general
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}