<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class RedirectForMobile
{
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();

        // Verifica se o dispositivo é móvel e se a rota não é "/orcamento"
        if ($agent->isMobile() && !$this->isOrcamentoRoute($request)) {
            // Redireciona para a rota /orcamento se não for acessada
            return redirect('/orcamento');
        }

        return $next($request);
    }

    /**
     * Verifica se a rota atual é a rota "orcamento" (com ou sem parâmetros).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isOrcamentoRoute(Request $request): bool
    {
        // Verifica se o caminho é 'orcamento' (completo ou contendo parâmetros adicionais)
        return $request->is('orcamento') || $request->is('orcamento/*');
    }
}
