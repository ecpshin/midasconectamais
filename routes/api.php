<?php

//use App\Http\Controllers\CallController;

use App\Http\Controllers\ApiTabelaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Ligacoes\LigacaoResource;
use App\Models\Ligacao;

// Route::prefix('call-center')->controller(CallController::class)->group(function () {
//     Route::get('/{id}/cliente', 'cliente')->name('api.cliente');
//     Route::patch('/{id}/cliente', 'clienteupdate')->name('api.call-center.update');
// });

Route::get('/{id}/cliente', function (string $id) {
    return new LigacaoResource(Ligacao::findOrFail($id));
})->name('api.cliente');

Route::controller(ApiTabelaController::class)->group(function () {
    Route::get('/testes', 'index')->name('api.index');
    Route::get('/tabelas/{id}', 'tabelas')->name('api.tabelas');
    Route::get('/tabela/{id}', 'tabela')->name('api.tabela');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
