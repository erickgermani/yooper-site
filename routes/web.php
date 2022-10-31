<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/app/home');

Route::prefix('app')->group(function() {
    Route::redirect('/', '/app/home');

    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/registrar', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/registrar', 'App\Http\Controllers\Auth\RegisterController@register');

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

        Route::get('/buscar', 'App\Http\Controllers\ClienteController@search')->name('cliente.buscar');

        Route::get('/cadastrar', 'App\Http\Controllers\ClienteController@create')->name('cliente.cadastrar');
        Route::post('/cadastrar', 'App\Http\Controllers\ClienteController@store');

        Route::get('/detalhes/{id}', 'App\Http\Controllers\ClienteController@show')->name('cliente.detalhes');

        Route::get('/atualizar/{id}', 'App\Http\Controllers\ClienteController@edit')->name('cliente.atualizar');
        Route::post('/atualizar/{id}', 'App\Http\Controllers\ClienteController@update');

        Route::get('/deletar/{id}', 'App\Http\Controllers\ClienteController@destroy')->name('cliente.deletar');
    });
});