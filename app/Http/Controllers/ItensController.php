<?php

namespace App\Http\Controllers;

use App\Models\PCFilial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ItensController extends Controller
{
    public function index()
    {
        return view('itens.index');
    }

    public function show(Request $request)
    {

        $request->validate([
            'filial' => 'required|numeric|min:1|max:14',
            'numnota' => 'required',
            'numcaixa' => 'required',
            'dtsaida' => 'required|date',
        ], [
            'filial.required' => 'Filial é Obrigatorio!',
            'dtsaida.required' => 'Data é Obrigatorio!',
            'dtsaida.date' => 'Data Deve Estar no Formato de Data!',
            'numnota.required' => 'Numero da nota é Obrigatorio!',
            'numcaixa.required' => 'Caixa é Obrigatorio!',
            'filial.numerico' => 'Filial deve ser um numero!',
            'filial.min' => 'A Filial deve ser no minimo 3!',
            'filial.max' => 'A filial deve ser no maximo 14',
        ]);

        $produtos = DB::select("
        SELECT m.dtmov,m.codfilial,m.codprod,m.codauxiliar,sum(m.qt) AS quantidade,TRUNC(m.punit + m.vldesconto,2) AS valornodia ,SUBSTR (buscaprecos(m.CODFILIAL,1,m.codauxiliar,SYSDATE ), 1, INSTR (buscaprecos(m.CODFILIAL,1,m.codauxiliar,SYSDATE ), ';', 1) - 1) AS valorhoje FROM pcnfsaid s LEFT JOIN pcmov m ON m.numtransvenda = s.numtransvenda
WHERE 1 = 1
AND s.codfilial = $request->filial
AND s.numnota = $request->numnota
AND s.caixa = $request->numcaixa
AND s.dtsaida = '$request->dtsaida'
AND m.qt > 0
GROUP BY m.dtmov,m.codfilial,m.codprod,m.codauxiliar,TRUNC(m.punit + m.vldesconto,2),SUBSTR (buscaprecos(m.CODFILIAL,1,m.codauxiliar,SYSDATE ), 1, INSTR (buscaprecos(m.CODFILIAL,1,m.codauxiliar,SYSDATE ), ';', 1) - 1)
        ");

        return view('itens.show', compact('produtos'));
    }

    public function atualizarProdutos()
    {
        Cache::forget('produtos_cache_key');
        return redirect()->to('/descricao');
    }
}
