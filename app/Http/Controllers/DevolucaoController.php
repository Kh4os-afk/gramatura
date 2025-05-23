<?php

namespace App\Http\Controllers;

use App\Models\PCFilial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevolucaoController extends Controller
{
    public function index()
    {
        return view('devolucao.index');
    }

    public function show(Request $request)
    {
        $request->validate([
            'filial' => 'required|numeric|min:3|max:14',
            'codauxiliar' => 'required|numeric',
            'dtinicial' => 'required|date',
            'dtfinal' => 'required|date',
            'punit' => 'required|numeric',
        ], [
            'filial.required' => 'Filial é Obrigatorio!',
            'dtinicial.required' => 'Data é Obrigatoria!',
            'dtfinal.required' => 'Data é Obrigatoria!',
            'filial.numerico' => 'Filial deve ser um numero!',
            'filial.min' => 'A Filial deve ser no minimo 3!',
            'filial.max' => 'A filial deve ser no maximo 14',
            'dtinicial.date' => 'A Data deve estar em formato de data!',
            'dtfinal.date' => 'A Data deve estar em formato de data!',
            'punit.required' => 'Preço é obrigatorio!',
            'punit.numeric' => 'Preço deve ser um numero!',
            'codauxiliar.required' => 'Codigo de Barras é Obrigatorio!',
            'codauxiliar.numeric' => 'Codigo de Barras deve ser numerico!',
        ]);

        $filial = PCFilial::find($request->filial);
        if ($filial) {
            $filial = $filial->contato;
        }

        $pmenor = $request->punit - 0.04;
        $pmaior = $request->punit + 0.04;

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
           AND M.DTMOV between '$request->dtinicial' and '$request->dtfinal'
           AND M.PUNIT between $pmenor and $pmaior
           AND M.CODAUXILIAR IN ($request->codauxiliar)
           AND M.CODOPER = 'S'
ORDER BY   CODPROD
        ");

        return view('devolucao.show', compact('produtos', 'filial'));
    }
}
