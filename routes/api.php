<?php

//use App\Http\Controllers\CallController;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
