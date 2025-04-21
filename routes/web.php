<?php

use App\Http\Controllers\ClienteController;
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
});
