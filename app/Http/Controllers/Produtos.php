<?php

namespace App\Http\Controllers;

use App\Models\PCFilial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Produtos extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function show(Request $request)
    {
        $request->validate([
            'filial' => 'required|numeric|min:1|max:14',
            'gramatura' => 'required|numeric',
            'data' => 'required|date',
        ], [
            'filial.required' => 'Filial é Obrigatorio!',
            'gramatura.required' => 'Gramatura é Obrigatorio!',
            'data.required' => 'Data é Obrigatoria!',
            'filial.numerico' => 'Filial deve ser um numero!',
            'filial.min' => 'A Filial deve ser no minimo 3!',
            'filial.max' => 'A filial deve ser no maximo 14',
            'gramatura.numeric' => 'A Gramatura deve ser um numero!',
            'data.date' => 'A Data deve estar em formato de data!',
        ]);

        $gramatura = $request->gramatura;

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
           AND M.QT <= $request->gramatura
           AND M.DTMOV = '$request->data'
           AND M.CODOPER = 'S'
ORDER BY   CODPROD
        ");

        return view('show', compact('produtos', 'filial', 'gramatura'));
    }
}
