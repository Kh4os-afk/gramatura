<?php

use Illuminate\Support\Facades\Route;

Route::get('/gramatura',[\App\Http\Controllers\GramaturaController::class,'index'])->name('index');
Route::post('/show',[\App\Http\Controllers\GramaturaController::class,'show'])->name('show');
Route::get('/descricao',[\App\Http\Controllers\DescricaoController::class,'index'])->name('descricao.index');
Route::get('/atualizar',[\App\Http\Controllers\DescricaoController::class,'atualizarProdutos'])->name('descricao.atualizar');
Route::post('/descricaoshow',[\App\Http\Controllers\DescricaoController::class,'show'])->name('descricao.show');
Route::get('/devolucao',[\App\Http\Controllers\DevolucaoController::class,'index'])->name('devolucao.index');
Route::post('/devolucaoshow',[\App\Http\Controllers\DevolucaoController::class,'show'])->name('devolucao.show');
Route::get('/itens',[\App\Http\Controllers\ItensController::class,'index'])->name('itens.index');
Route::post('/itensshow',[\App\Http\Controllers\ItensController::class,'show'])->name('itens.show');

Route::fallback(function () {
    return redirect()->route('index');
});
