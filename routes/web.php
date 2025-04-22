<?php

use App\Http\Controllers\CaminhaoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoFornecedorController;
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

    Route::resource('clientes', ClienteController::class);
    Route::resource('caminhao', CaminhaoController::class);
    Route::resource('fornecedor', FornecedorController::class);
    Route::resource('motorista', MotoristaController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('produtofornecedor', ProdutoFornecedorController::class);
    Route::resource('pedidos', PedidosController::class);

    Route::get('fornecedor/{id}/produtos', [ProdutoController::class, 'produtosPorFornecedor']);
    Route::get('produto/{id}', [ProdutoController::class, 'valorPorProduto']);
});
