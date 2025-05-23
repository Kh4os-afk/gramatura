@extends('layouts.app')

@section('content')

    @section('title','Produtos')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="tile">
                <form action="{{ route('show') }}" method="POST">
                    @csrf
                    <h3 class="tile-title">Buscar Produtos Por Gramatura</h3>
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
                            <label class="control-label" for="gramatura">Gramatura</label>
                            <select id="gramatura" class="form-control @error('gramatura') is-invalid @enderror" name="gramatura">
                                <option value="0.50">0.50 KG</option>
                                <option value="0.20">0.20 KG</option>
                                <option value="0.15">0.15 KG</option>
                                <option value="0.10">0.10 KG</option>
                                <option value="0.09">0.09 KG</option>
                                <option value="0.08">0.08 KG</option>
                                <option value="0.07">0.07 KG</option>
                                <option value="0.06">0.06 KG</option>
                                <option value="0.05">0.05 KG</option>
                                <option value="0.04">0.04 KG</option>
                                <option value="0.03">0.03 KG</option>
                                <option value="0.02">0.02 KG</option>
                                <option value="0.01">0.01 KG</option>
                            </select>
                            @error('gramatura')
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
                        <button class="btn btn-secondary" type="button">
                            <a style="color: white; text-decoration: none" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

