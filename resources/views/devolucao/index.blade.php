@extends('layouts.app')

@section('content')

    @section('title','Devolução')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="tile">
                <form action="{{ route('devolucao.show') }}" method="POST">
                    @csrf
                    <h3 class="tile-title">Buscar Produto Para Devolução</h3>
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
                            <label class="control-label">Cod Auxiliar</label>
                            <input class="form-control @error('codauxiliar') is-invalid @enderror" type="number" name="codauxiliar" value="123">
                            @error('codauxiliar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Preço</label>
                            <input class="form-control @error('punit') is-invalid @enderror" type="number" name="punit" min="0" max="9999" step="0.01" placeholder="R$ 1,08">
                            @error('punit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Data Inicial</label>
                            <input class="form-control @error('dtinicial') is-invalid @enderror" type="date" name="dtinicial" value="{{ Carbon\Carbon::yesterday()->format('Y-m-d') }}">
                            @error('dtinicial')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Data Final</label>
                            <input class="form-control @error('dtfinal') is-invalid @enderror" type="date" name="dtfinal" value="{{ Carbon\Carbon::yesterday()->format('Y-m-d') }}">
                            @error('dtfinal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Buscar
                        </button>
                        <button class="btn btn-secondary" type="button">
                            <a style="color: white; text-decoration: none" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

