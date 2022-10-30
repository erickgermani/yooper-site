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

Route::redirect('/', '/app/home');

Route::auth();

Route::prefix('app')->group(function() {
    Route::redirect('/', '/app/home');

    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('app.login');

    Route::middleware('auth')->get('/home', function() {
        return view('home');
    })->name('home');

    Route::get('/feedback', function() {
        return view('feedback');
    })->name('feedback');

    Route::prefix('cliente')
        ->middleware('auth')
        ->group(function() {
        Route::redirect('/', '/app/cliente/listar');

        Route::get('/listar', 'App\Http\Controllers\ClienteController@index')->name('cliente.listar');

        Route::get('/cadastrar', 'App\Http\Controllers\ClienteController@create')->name('cliente.cadastrar');
        Route::post('/cadastrar', 'App\Http\Controllers\ClienteController@store')->name('cliente.cadastrar');

        Route::get('/detalhes/{id}', 'App\Http\Controllers\ClienteController@show')->name('cliente.detalhes');

        Route::get('/atualizar/{id}', 'App\Http\Controllers\ClienteController@edit')->name('cliente.atualizar');
        Route::post('/atualizar/{id}', 'App\Http\Controllers\ClienteController@update')->name('cliente.atualizar');

        Route::get('/deletar/{id}', 'App\Http\Controllers\ClienteController@destroy')->name('cliente.deletar');
    });
});