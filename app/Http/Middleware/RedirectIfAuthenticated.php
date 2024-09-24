<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        // Verifica se o usuário está autenticado
        if (Auth::guard($guard)->check()) {
            // Instancia o agente
            $agent = new Agent();

            // Verifica se é um dispositivo móvel
            if ($agent->isMobile()) {
                // Se estiver logado e tentar acessar /login, redireciona para /orcamento
                return redirect('/orcamento');
            }
        }

        return $next($request);
    }
}
