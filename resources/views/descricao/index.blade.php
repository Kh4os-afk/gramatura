@extends('layouts.app')

@section('content')

    @section('title','Protudos')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="tile">
                <form action="{{ route('descricao.show') }}" method="POST">
                    @csrf
                    <h3 class="tile-title">Buscar Produtos Por Descrição</h3>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label">Filial</label>
                            <input class="form-control @error('filial') is-invalid @enderror" type="number" name="filial" value="3">
                            @error('filial')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="produtos">Produtos - Segure CTRL Para Selecionar Varios</label>
                            <select class="js-example-basic-multiple form-control @error('codauxiliar') is-invalid @enderror" name="codauxiliar[]" multiple="multiple">
                                @forelse($produtos as $produto)
                                    <option value="{{ $produto->codauxiliar }}">{{ $produto->codauxiliar }} - {{ $produto->descricao }}</option>
                                @empty
                                    <option value="1">Sem Dado!</option>
                                @endforelse
                            </select>
                            @error('codauxiliar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Data</label>
                            <input class="form-control @error('data') is-invalid @enderror" type="date" name="data" value="{{ Carbon\Carbon::yesterday()->format('Y-m-d') }}">
                            @error('data')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Buscar
                        </button>
                        <button class="btn btn-warning" type="button">
                            <a style="color: white; text-decoration: none" href="{{ route('descricao.atualizar') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Atualizar Produtos</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

