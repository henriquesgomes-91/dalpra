<?php

use App\Http\Controllers\CaminhaoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoFornecedorController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if( Auth::check() )
        return redirect()->signedRoute('home');

    return view('auth.login');
})->name('root');


Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::group(['name' => 'caminhao', 'as' => 'caminhao.', 'prefix' => 'caminhao'], function () {
        Route::get('/', [CaminhaoController::class, 'index'])->name('index');
        Route::get('create', [CaminhaoController::class, 'create'])->name('create');
        Route::post('store', [CaminhaoController::class, 'store'])->name('store');
        Route::get('show/{id}/{str}', [CaminhaoController::class, 'remove'])->name('remove');
        Route::delete('destroy/{id}', [CaminhaoController::class, 'destroy'])->name('destroy');
        Route::get('edit/{id}', [CaminhaoController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CaminhaoController::class, 'update'])->name('update');
        Route::get('show/{id}/{str}', [CaminhaoController::class, 'show'])->name('show');
    });

    Route::group(['name' => 'motorista', 'as' => 'motorista.', 'prefix' => 'motorista'], function () {
        Route::get('/', [MotoristaController::class, 'index'])->name('index');
        Route::get('create', [MotoristaController::class, 'create'])->name('create');
        Route::post('store', [MotoristaController::class, 'store'])->name('store');
        Route::get('show/{id}/{str}', [MotoristaController::class, 'remove'])->name('remove');
        Route::delete('destroy/{id}', [MotoristaController::class, 'destroy'])->name('destroy');
        Route::get('edit/{id}', [MotoristaController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [MotoristaController::class, 'update'])->name('update');
        Route::get('show/{id}/{str}', [MotoristaController::class, 'show'])->name('show');
    });

    Route::group(['name' => 'fornecedor', 'as' => 'fornecedor.', 'prefix' => 'fornecedor'], function () {
        Route::get('/', [FornecedorController::class, 'index'])->name('index');
        Route::get('create', [FornecedorController::class, 'create'])->name('create');
        Route::post('store', [FornecedorController::class, 'store'])->name('store');
        Route::get('show/{id}/{str}', [FornecedorController::class, 'remove'])->name('remove');
        Route::delete('destroy/{id}', [FornecedorController::class, 'destroy'])->name('destroy');
        Route::get('edit/{id}', [FornecedorController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [FornecedorController::class, 'update'])->name('update');
        Route::get('show/{id}/{str}', [FornecedorController::class, 'show'])->name('show');

        Route::group(['name' => 'produto', 'as' => 'produto.', 'prefix' => '{idFornecedor}/produto'], function () {
            Route::get('/', [ProdutoFornecedorController::class, 'index'])->name('index');
            Route::get('create', [ProdutoFornecedorController::class, 'create'])->name('create');
            Route::post('store', [ProdutoFornecedorController::class, 'store'])->name('store');
            Route::get('show/{id}/{str}', [ProdutoFornecedorController::class, 'remove'])->name('remove');
            Route::delete('destroy/{id}', [ProdutoFornecedorController::class, 'destroy'])->name('destroy');
            Route::get('edit/{id}', [ProdutoFornecedorController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [ProdutoFornecedorController::class, 'update'])->name('update');
            Route::get('show/{id}/{str}', [ProdutoFornecedorController::class, 'show'])->name('show');
        });

    });


    Route::group(['name' => 'produto', 'as' => 'produto.', 'prefix' => 'produto'], function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('index');
        Route::get('create', [ProdutoController::class, 'create'])->name('create');
        Route::post('store', [ProdutoController::class, 'store'])->name('store');
        Route::get('show/{id}/{str}', [ProdutoController::class, 'remove'])->name('remove');
        Route::delete('destroy/{id}', [ProdutoController::class, 'destroy'])->name('destroy');
        Route::get('edit/{id}', [ProdutoController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProdutoController::class, 'update'])->name('update');
        Route::get('show/{id}/{str}', [ProdutoController::class, 'show'])->name('show');
    });

    Route::resource('clientes', ClienteController::class);
    Route::resource('pedidos', PedidosController::class);
    Route::resource('entregas', EntregaController::class);

    Route::get('caminhao/remove/{id}', [CaminhaoController::class, 'remove']);

    Route::get('fornecedor/{id}/produtos', [ProdutoController::class, 'produtosPorFornecedor']);
    Route::get('produto/{idFornecedor}/{idProduto}/preco', [ProdutoController::class, 'valorPorProduto']);
    Route::get('/pedido/{id}/itens', [EntregaController::class, 'getItens']);

    Route::get('/relatorios/entregas', [RelatorioController::class, 'index'])->name('relatorio.entregas');
    Route::post('/relatorios/entregas', [RelatorioController::class, 'generate'])->name('relatorio.entregas.generate');
    Route::get('/relatorios/entregas/exportar', [RelatorioController::class, 'exportar'])->name('relatorio.entregas.exportar');
});
