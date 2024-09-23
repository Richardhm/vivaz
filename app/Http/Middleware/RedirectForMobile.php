<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class RedirectForMobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();

        // Verifica se o dispositivo é móvel e se a rota não é "/orcamento"
        if ($agent->isMobile() && $request->path() !== 'orcamento') {
            // Redireciona para a rota /orcamento
            return redirect('/orcamento');
        }

        return $next($request);
    }
}
