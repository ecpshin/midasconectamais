<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenteMailingController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComissaoController;
use App\Http\Controllers\CorrespondenteController;
use App\Http\Controllers\FinanceiraController;
use App\Http\Controllers\InfoBancariaController;
use App\Http\Controllers\InfoResidencialController;
use App\Http\Controllers\LigacaoController;
use App\Http\Controllers\MailingController;
use App\Http\Controllers\OrganizacaoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropostaController;
use App\Http\Controllers\SituacaoController;
use App\Http\Controllers\TabelaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VinculoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminController::class, 'admin'])->middleware(['auth', 'verified'])->name('admin');

Route::get('admin', [AdminController::class, 'admin'])->middleware(['auth', 'verified'])->name('admin');

Route::prefix('admin/agentes')->name('admin.agentes.')
    ->controller(UsersController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/registrar-usuario', 'create')->name('create');
        Route::post('/registrar-usuario', 'store')->name('store');
        Route::get('/{user}/agente-profile', 'edit')->name('perfil');
        Route::patch('/{user}/atualizar-dados-pessoais', 'pessoais')->name('pessoais');
        Route::patch('/{user}/atualizar-senha', 'senhaUpdate')->name('password');
    });

Route::prefix('admin/clientes')->name('admin.clientes.')
    ->controller(ClienteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cadastrar-cliente', 'create')->name('create');
        Route::post('/save-cliente', 'store')->name('store');
        Route::get('/{cliente}/exibir-cliente', 'show')->name('show');
        Route::get('/{cliente}/editar-cliente', 'edit')->name('edit');
        Route::patch('/{cliente}/atualiza-dados-cliente', 'update')->name('update');
        Route::delete('/{cliente}/excluir-cliente', 'destroy')->name('destroy');
    });

Route::prefix('admin/correspondentes')->name('admin.correspondentes.')
    ->controller(CorrespondenteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cadastrar-correspondente', 'create')->name('create');
        Route::get('/{correspondente}/exibir-correspondente', 'show')->name('show');
        Route::post('/save-correspondente', 'store')->name('store');
        Route::get('/{correspondente}/editar-correspondente', 'edit')->name('edit');
        Route::patch('/{correspondente}/atualiza-dados-correspondente', 'update')->name('update');
        Route::delete('/{correspondente}/excluir-correspondente', 'destroy')->name('destroy');
    });

Route::prefix('admin/financeiras')->name('admin.financeiras.')
    ->controller(FinanceiraController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cadastrar-financeira', 'create')->name('create');
        Route::post('/save-financeira', 'store')->name('store');
        Route::get('/{financeira}/exibir-financeira', 'show')->name('show');
        Route::get('/{financeira}/editar-financeira', 'edit')->name('edit');
        Route::patch('/{financeira}/atualiza-dados-financeira', 'update')->name('update');
        Route::delete('/{financeira}/excluir-financeira', 'destroy')->name('destroy');
    });

Route::prefix('admin/organizacoes')->name('admin.organizacoes.')
    ->controller(OrganizacaoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cadastrar-orgao', 'create')->name('create');
        Route::post('/cadastrar-orgao', 'store')->name('store');
        Route::get('/{organizacao}/exibir-orgao', 'show')->name('show');
        Route::get('/{organizacao}/editar-orgao', 'edit')->name('edit');
        Route::patch('/{organizacao}/atualiza-dados-orgao', 'update')->name('update');
        Route::delete('/{organizacao}/excluir-orgao', 'destroy')->name('destroy');
    });

Route::prefix('admin/produtos')->name('admin.produtos.')
    ->controller(ProdutoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cadastrar-produto', 'create')->name('create');
        Route::post('/cadastrar-produto', 'store')->name('store');
        Route::get('/{produto}/exibir-produto', 'show')->name('show');
        Route::get('/{produto}/editar-produto', 'edit')->name('edit');
        Route::patch('/{produto}/atualiza-dados-produto', 'update')->name('update');
        Route::delete('/{produto}/excluir-produto', 'destroy')->name('destroy');
    });

Route::prefix('admin/situacoes')->name('admin.situacoes.')
    ->controller(SituacaoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cadastrar-situacao', 'create')->name('create');
        Route::post('/save-situacao', 'store')->name('store');
        Route::get('/{situacao}/exibir-situacao', 'show')->name('show');
        Route::get('/{situacao}/editar-situacao', 'edit')->name('edit');
        Route::patch('/{situacao}/atualiza-dados-situacao', 'update')->name('update');
        Route::delete('/{situacao}/excluir-situacao', 'destroy')->name('destroy');
    });

Route::prefix('/admin/clientes')->name('admin.')
    ->group(function () {
        Route::get('/{infoResidencial}/dado-residencial', [InfoResidencialController::class, 'edit'])->name('dados-residenciais.edit');
        Route::patch('/{infoResidencial}/dado-residencial', [InfoResidencialController::class, 'update'])->name('dados-residenciais.update');
        Route::get('/{infoBancaria}/dado-bancario', [InfoBancariaController::class, 'edit'])->name('dados-bancarios.edit');
        Route::patch('/{infoBancaria}/dado-bancario', [InfoBancariaController::class, 'update'])->name('dados-bancarios.update');
        Route::get('/{vinculo}/dado-funcional', [VinculoController::class, 'edit'])->name('dados-funcionais.edit');
        Route::patch('/{vinculo}/dado-funcional', [VinculoController::class, 'update'])->name('dados-funcionais.update');
    });

Route::prefix('admin/propostas')->controller(PropostaController::class)->name('admin.propostas.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/nova-proposta', 'create')->name('create');
        Route::post('/salvar-proposta', 'store')->name('store');
        Route::get('/{proposta}/editar-proposta', 'edit')->name('edit');
        Route::patch('/{proposta}/atualizar-proposta', 'update')->name('update');
        Route::get('/{proposta}/exibir-proposta', 'show')->name('show');
        Route::delete('/{proposta}/excluir-proposta', 'destroy')->name('destroy');

        Route::get('/filtrar-por-data', 'filtrarPorData')->name('filtrar-por-data');
        Route::post('/aplicar-filtro-por-data', 'pordata')->name('aplicar_filtro_por_data');
        Route::get('/filtrar-por-agente', 'pagePropostaPorAgente')->name('propostas-por-agente');
        Route::post('/filtrar-por-agente', 'producaoPorAgente')->name('producao-por-agente');
    })->middleware(['auth', 'verified']);

Route::prefix('admin/comissoes')->controller(ComissaoController::class)
    ->name('admin.comissoes.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'index')->name('index');
        Route::get('/create-comissoes', 'create')->name('create');
        Route::get('/{comissao}/editar-comissao', 'edit')->name('edit');
        Route::patch('/{comissao}/update-comissao', 'update')->name('update');
        Route::delete('/{comissao}/excluir-comissao', 'destroy')->name('destroy');
        Route::get('/{comissao}/exibir-comissao', 'show')->name('show');

        Route::get('/ajuste-por-agente', 'porAgente')->name('ajustar');
        Route::post('/comissoes-por-agente', 'porAgente')->name('agente');
    })->middleware(['role:super-admin', 'auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('admin/mailings')->name('admin.mailings.')->controller(MailingController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/import-mailing', 'create')->name('create');
        Route::get('/{mailing}/editar', 'edit')->name('edit');
        Route::patch('/{mailing}/atualizar', 'update')->name('update');
        Route::delete('/{mailing}/excluir', 'destroy')->name('destroy');
        Route::get('/{mailing}/exibir', 'show')->name('show');
        Route::post('/mailing-attach-agent', 'store')->name('store');
        Route::post('import/mailing', 'import')->name('import');
    })->middleware(['auth', 'verified']);

Route::prefix('admin/mailings/agentes')->controller(AgenteMailingController::class)->name('mailings.agents.')
    ->group(function () {
        Route::post('/agentes/attach-mailing', 'store')->name('store');
    });

Route::prefix('admin/tabelas')->name('admin.tabelas.')
    ->controller(TabelaController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/registrar', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{tabela}/show', 'show')->name('show');
        Route::get('/{tabela}/edit', 'edit')->name('edit');
        Route::patch('/{tabela}/update', 'update')->name('update');
        Route::delete('/{tabela}/delete', 'destroy')->name('destroy');

        Route::get('/tabela-correspondente/{id}', 'getcorrespontes')->name('correspondentes');
        Route::get('/tabela-correspondente-financeira/{id}', 'getfinanceiras')->name('financeiras');
    })->middleware(['auth', 'verified']);

// Route::prefix('admin/tabelas')->name('admin.tabelas.')
//     ->controller(TabelaController::class)->group(function () {
//         Route::get('/', 'index')->name('index');
//         Route::get('/registrar-tabela', 'create')->name('create');
//         Route::post('/salvar-tabela', 'store')->name('create');
//         Route::get('/{tabela}/editar-tabela', 'edit')->name('edit');
//         Route::patch('/{tabela}/atualizar-tabela', 'update')->name('update');
//         Route::get('/{tabela}/exibir-tabela', 'show')->name('show');
//         Route::delete('/{tabela}/excluir-tabela', 'destroy')->name('destroy');

//         Route::get('/search/{id}', 'get_tabela')->name('search');
//     });

Route::prefix('admin/call-center')->name('admin.calls.')
    ->controller(LigacaoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/nova-ligacao', 'create')->name('create');
        Route::post('/salvar-ligacao', 'store')->name('store');
        Route::get('/{ligacao}/editar-ligacao', 'edit')->name('edit');
        Route::patch('/{ligacao}/atualizar-ligacao', 'update')->name('update');
        Route::delete('/{ligacao}/excluir-ligacao', 'destroy')->name('destroy');
        Route::get('/{ligacao}/exibir-ligacao', 'show')->name('show');

        Route::get('/prefeituras', 'prefeituras')->name('prefeituras');
        Route::get('/governos', 'governos')->name('governos');
        Route::get('/agendados', 'agendados')->name('agendados');
        Route::post('/agendados', 'agendados')->name('lista-agendados');

        Route::get('/ligacoes-operadores', 'gerenciar')->name('gerenciar');
        Route::post('/ligacoes-operadores', 'filtrar')->name('filtrar');
        Route::get('/{ligacao}/propostas-call-center', 'proposta')->name('propostas');
    });


/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/
