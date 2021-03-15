<?php

use Illuminate\Http\Request;
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

Route::prefix('user')->middleware(['auth:api'])->group(function () {
	Route::get('', [App\Http\Controllers\Auth\UserController::class, 'user']);
	Route::put('', [App\Http\Controllers\Auth\UserController::class, 'update']);
});

Route::prefix('saludos')->middleware(['auth:api'])->group(function () {
	Route::get('', [App\Http\Controllers\SaludoController::class, 'index']);
	Route::post('', [App\Http\Controllers\SaludoController::class, 'store']);
	Route::get('{id}', [App\Http\Controllers\SaludoController::class, 'show']);
	Route::put('{id}', [App\Http\Controllers\SaludoController::class, 'update']);
	Route::delete('{id}', [App\Http\Controllers\SaludoController::class, 'delete']);
});

Route::prefix('dependencias')->middleware(['auth:api'])->group(function () {
	Route::get('', [App\Http\Controllers\DependenciaController::class, 'index']);
	Route::post('', [App\Http\Controllers\DependenciaController::class, 'store']);
	Route::get('{id}', [App\Http\Controllers\DependenciaController::class, 'show']);
	Route::put('{id}', [App\Http\Controllers\DependenciaController::class, 'update']);
	Route::delete('{id}', [App\Http\Controllers\DependenciaController::class, 'delete']);
});

Route::prefix('entidades')->middleware(['auth:api'])->group(function () {
	Route::get('', [App\Http\Controllers\EntidadController::class, 'index']);
	Route::post('', [App\Http\Controllers\EntidadController::class, 'store']);
	Route::get('{id}', [App\Http\Controllers\EntidadController::class, 'show']);
	Route::put('{id}', [App\Http\Controllers\EntidadController::class, 'update']);
	Route::delete('{id}', [App\Http\Controllers\EntidadController::class, 'delete']);
});

Route::prefix('cargos')->middleware(['auth:api'])->group(function () {
	Route::get('', [App\Http\Controllers\CargoController::class, 'index']);
	Route::post('', [App\Http\Controllers\CargoController::class, 'store']);
	Route::get('{id}', [App\Http\Controllers\CargoController::class, 'show']);
	Route::put('{id}', [App\Http\Controllers\CargoController::class, 'update']);
	Route::delete('{id}', [App\Http\Controllers\CargoController::class, 'delete']);
});

Route::prefix('destinatarios')->middleware(['auth:api'])->group(function () {
	Route::get('', [App\Http\Controllers\DestinatarioController::class, 'index']);
	Route::post('', [App\Http\Controllers\DestinatarioController::class, 'store']);
	Route::get('{id}', [App\Http\Controllers\DestinatarioController::class, 'show']);
	Route::put('{id}', [App\Http\Controllers\DestinatarioController::class, 'update']);
	Route::delete('{id}', [App\Http\Controllers\DestinatarioController::class, 'delete']);
});

Route::prefix('oficios')->middleware(['auth:api'])->group(function () {
	Route::get('', [App\Http\Controllers\DocumentoController::class, 'index']);
	Route::post('', [App\Http\Controllers\DocumentoController::class, 'store']);
	Route::get('{id}', [App\Http\Controllers\DocumentoController::class, 'show']);
});
