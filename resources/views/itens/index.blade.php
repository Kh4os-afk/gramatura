@extends('layouts.app')

@section('content')

    @section('title','Itens de Nota')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="tile">
                <form action="{{ route('itens.show') }}" method="POST">
                    @csrf
                    <h3 class="tile-title">Buscar Itens de Uma Nota</h3>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label">Filial</label>
                            <input class="form-control @error('filial') is-invalid @enderror" type="number" name="filial" placeholder="3">
                            @error('filial')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Num Nota</label>
                            <input class="form-control @error('numnota') is-invalid @enderror" type="number" name="numnota" placeholder="123">
                            @error('numnota')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Caixa</label>
                            <input class="form-control @error('numcaixa') is-invalid @enderror" type="number" name="numcaixa" min="0" max="9999" step="1" placeholder="101">
                            @error('numcaixa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Data</label>
                            <input class="form-control @error('dtsaida') is-invalid @enderror" type="date" name="dtsaida" min="0" max="9999" step="1" value="{{ now()->format('Y-m-d')  }}">
                            @error('dtsaida')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="text-danger" style="font-size: 12px">Tenha em mente que a nota pode ter sido faturada dias após ser passada no caixa. Confira a nota fiscal eletrônica na rotina 1452 em caso de NF-e.</div>
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

