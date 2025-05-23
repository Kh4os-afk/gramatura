@extends('layouts.app')

@section('content')

    @section('title','Itens da Nota')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Itens da Nota</h3>
                <h3 class="tile-title">Atenção - Relatorio em Teste Confira as Informações</h3>
                <div class="tile-body">
                    <table id="table" class="display compact">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Filial</th>
                            <th>Cod Produto</th>
                            <th>Cod Auxiliar</th>
                            <th>Quantidade</th>
                            <th>Valor no Dia</th>
                            <th>Valor Hoje</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($produtos as $produto)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($produto->dtmov)->format('d/m/Y') }}</td>
                                <td>{{ $produto->codfilial }}</td>
                                <td>{{ $produto->codprod }}</td>
                                <td>{{ $produto->codauxiliar }}</td>
                                <td>{{ number_format($produto->quantidade,2) }} Kg</td>
                                <td>R$ {{ number_format($produto->valornodia,2) }}</td>
                                <td>R$ {{ number_format($produto->valorhoje,2) }}</td>
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
