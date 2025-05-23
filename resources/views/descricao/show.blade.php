@extends('layouts.app')

@section('content')

    @section('title','Protudos ' . ucwords(strtolower($filial)))

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Produtos Por Descrição {{ ucwords(strtolower($filial)) }}</h3>
            <div class="tile-body">
                <table id="table" class="display compact">
                    <thead>
                    <tr>
                        <th>Cod Auxiliar</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Valor</th>
                        <th>Nota</th>
                        <th>Caixa</th>
                        <th>Hora</th>
                        <th>Operador</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($produtos as $produto)
                        <tr>
                            <td>{{ $produto->codauxiliar }}</td>
                            <td>{{ $produto->descricao }}</td>
                            <td>{{ number_format($produto->qt,3) }}</td>
                            <td>R$ {{ number_format($produto->punit,2) }}</td>
                            <td>R$ {{ number_format($produto->qt * $produto->punit,2) }}</td>
                            <td><a href="{{ $produto->qrcodenfce }}" target="_blank">{{ $produto->numnota }}</a></td>
                            <td>{{ $produto->caixa }}</td>
                            <td>{{ $produto->hora }}</td>
                            <td>{{ $produto->nome }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                            <th>Sem Dados!</th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tile-footer"></div>
        </div>
    </div>
</div>

@endsection
