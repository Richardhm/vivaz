<?php

namespace App\Http\Controllers;

use App\Models\ComissoesCorretoresDefault;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Http\Request;

class ComissoesController extends Controller
{
    public function index(Request $request)
    {
        $planos = Plano::all();
        $planoSelecionado = $request->input('plano_id');
        $comissoesPorAdministradora = [];
        $comissoes = "";

        $parceiros = User::where('corretora_id', auth()->user()->corretora_id)
            ->whereHas('comissoesConfig')
            ->get();

        // Mapeamento das administradoras
        $administradoras = [
            1 => 'AllCare',
            2 => 'Qualicorp',
            3 => 'Alter',
        ];
        $corretora_id = auth()->user()->corretora_id;
        if ($planoSelecionado) {
            if ($planoSelecionado == 3) {
                // Buscar comissões agrupadas por administradora_id
                $comissoes = ComissoesCorretoresDefault
                    ::where('plano_id', $planoSelecionado)
                    ->where('corretora_id',$corretora_id)
                    ->get()
                    ->groupBy('administradora_id');

                $comissoesPorAdministradora = $comissoes;
            } else {
                // Buscar comissões padrão
                $comissoes = ComissoesCorretoresDefault
                    ::where('plano_id', $planoSelecionado)
                    ->where('corretora_id',$corretora_id)
                    ->get();
            }
        }

        return view('comissoes.index', compact('planos', 'comissoes','parceiros','planoSelecionado', 'comissoesPorAdministradora', 'administradoras'));
    }


    public function buscarComissoesParceiros(Request $request)
    {
        $user_id = $request->input('user_id');

        $comissoes = \DB::table('comissoes_corretores_configuracoes')
            ->join('planos', 'comissoes_corretores_configuracoes.plano_id', '=', 'planos.id')
            ->leftJoin('administradoras', 'comissoes_corretores_configuracoes.administradora_id', '=', 'administradoras.id')
            ->select(
                'comissoes_corretores_configuracoes.*',
                'planos.nome as plano_nome',
                'administradoras.nome as administradora_nome'
            )
            ->where('user_id', $user_id)
            ->get()
            ->groupBy(function ($item) {
                if ($item->plano_id == 3) {
                    return "{$item->plano_nome}-{$item->administradora_nome}";
                }
                return $item->plano_nome;
            });

        return response()->json($comissoes);
    }

    public function atualizarComissao(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:comissoes_corretores_configuracoes,id',
            'valor' => 'required|numeric|min:0',
        ]);

        try {
            \DB::table('comissoes_corretores_configuracoes')
                ->where('id', $validated['id'])
                ->update(['valor' => $validated['valor']]);

            return response()->json([
                'success' => true,
                'message' => 'Comissão atualizada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a comissão.',
            ], 500);
        }
    }










    public function update(Request $request, $planoId)
    {
        $comissoes = $request->input('comissoes');
        foreach ($comissoes as $id => $data) {
            ComissoesCorretoresDefault::where('id', $id)->update(['valor' => $data['valor']]);
        }
        return redirect()->route('comissoes.index', ['plano_id' => $planoId])
            ->with('success', 'Comissões atualizadas com sucesso!');
    }

    public function updateComissao(Request $request)
    {
        $comissaoId = $request->input('comissao_id');
        $novoValor = $request->input('valor');

        $comissao = ComissoesCorretoresDefault::find($comissaoId);

        if ($comissao) {
            $comissao->valor = $novoValor;
            $comissao->save();

            return response()->json(['success' => true, 'message' => 'Valor atualizado com sucesso!']);
        }

        return response()->json(['success' => false, 'message' => 'Comissão não encontrada.'], 404);
    }


    public function postComissoes(Request $request)
    {
        $planoId = $request->input('plano_id');

        // Mapeamento das administradoras
        $administradoras = [
            1 => 'AllCare',
            2 => 'Qualicorp',
            3 => 'Alter',
        ];

        $comissoesPorAdministradora = [];

        if ($planoId == 3) {
            $comissoes = ComissoesCorretoresDefault::where('plano_id', $planoId)
                ->where("corretora_id",auth()->user()->corretora_id)
                ->get()
                ->groupBy('administradora_id');

            foreach ($comissoes as $administradoraId => $comissoes) {
                $comissoesPorAdministradora[] = [
                    'administradora' => $administradoras[$administradoraId] ?? 'Desconhecida',
                    'comissoes' => $comissoes,
                ];
            }
        } else {
            $comissoes = ComissoesCorretoresDefault::where('plano_id', $planoId)
                ->where("corretora_id",auth()->user()->corretora_id)
                ->get();
            $comissoesPorAdministradora[] = [
                'administradora' => null,
                'comissoes' => $comissoes,
            ];
        }

        return response()->json($comissoesPorAdministradora);
    }



}
