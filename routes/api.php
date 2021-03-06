<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('depositar/{conta}/{valor}', 'ContaController@depositar');
Route::get('sacar/{conta}/{valor}', 'ContaController@sacar');
Route::get('saldo/{conta}', 'ContaController@saldo');