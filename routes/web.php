<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'app/home');

// Route::auth();

Route::get('/app/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('app.login');

// Route::middleware('auth')->prefix('app')->group(function() {
//     Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
//     Route::resource('cliente', ClienteController::class);
// });

/* ROTA PARA TESTE */
Route::prefix('app')->group(function() {
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    // Route::resource('cliente', ClienteController::class);

    Route::prefix('cliente')->group(function() {
        Route::redirect('/', 'cliente/listar');

        Route::get('/listar', 'App\Http\Controllers\ClienteController@listar')->name('cliente.listar');

        Route::get('/cadastrar', 'App\Http\Controllers\ClienteController@cadastrar')->name('cliente.cadastrar');
        Route::post('/cadastrar', 'App\Http\Controllers\ClienteController@store')->name('cliente.cadastrar');

        Route::get('/detalhes/{id}', 'App\Http\Controllers\ClienteController@detalhes')->name('cliente.detalhes');
    });
});