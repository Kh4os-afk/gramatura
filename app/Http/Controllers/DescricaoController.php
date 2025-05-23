<?php

namespace App\Http\Controllers;

use App\Models\PCFilial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DescricaoController extends Controller
{
    public function index()
    {
        /*Apagar cache*/
        /* Cache::forget('produtos_cache_key2'); */
        $produtos = Cache::remember('produtos_cache_key2', 60 * 60 * 24, function () {
            return DB::select("
        SELECT   DISTINCT
           (E.CODAUXILIAR), P.DESCRICAO || ' ' || P.EMBALAGEM AS DESCRICAO
    FROM           PCEMBALAGEM E
               INNER JOIN
                   PCPRODUT P
               ON     P.CODPROD = E.CODPROD
                  --AND P.OBS2 <> 'FL'
                  AND P.DTEXCLUSAO IS NULL
                  AND NVL(E.PVENDA,0) <> 0
                  AND NVL(E.EXCLUIDO,'N') = 'N'
ORDER BY  E.CODAUXILIAR ASC
        ");
        });

        return view('descricao.index', compact('produtos'));
    }

    public function show(Request $request)
    {

        $request->validate([
            'filial' => 'required|numeric|min:3|max:14',
            'codauxiliar' => 'required',
            'data' => 'required|date',
        ], [
            'filial.required' => 'Filial é Obrigatorio!',
            'codauxiliar.required' => 'Codigo de Barras é Obrigatorio!',
            'data.required' => 'Data é Obrigatoria!',
            'filial.numerico' => 'Filial deve ser um numero!',
            'filial.min' => 'A Filial deve ser no minimo 3!',
            'filial.max' => 'A filial deve ser no maximo 14',
            'data.date' => 'A Data deve estar em formato de data!',
        ]);

        $codauxiliar = implode(',', $request->codauxiliar);

        $filial = PCFilial::find($request->filial);
        if ($filial) {
            $filial = $filial->contato;
        }

        $produtos = DB::select("
  SELECT   M.CODAUXILIAR,
           M.CODPROD,
           M.DESCRICAO,
           M.QT,
           M.PUNIT,
           M.NUMNOTA,
           S.CAIXA,
           TO_CHAR(P.HORA,'00') || ':' || TO_CHAR(P.MINUTO,'00') AS HORA,
           S.QRCODENFCE,
           TO_CHAR (E.MATRICULA, '0000') || ' - ' || E.NOME AS NOME
    FROM           PCMOV M
               INNER JOIN
                   PCNFSAID S
               ON M.NUMTRANSVENDA = S.NUMTRANSVENDA
           INNER JOIN
               PCPEDC P
           ON S.NUMPED = P.NUMPED
        INNER JOIN
            PCEMPR E
        ON E.MATRICULA = S.CODEMITENTE
   WHERE       M.CODFILIAL = $request->filial
           AND M.DTCANCEL IS NULL
           AND M.CODAUXILIAR IN ($codauxiliar)
           AND M.DTMOV = '$request->data'
           AND M.CODOPER = 'S'
ORDER BY   CODPROD
        ");

        return view('descricao.show', compact('produtos', 'filial'));
    }

    public function atualizarProdutos()
    {
        Cache::forget('produtos_cache_key2');
        return redirect()->to('/descricao');
    }
}
