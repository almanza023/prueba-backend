<?php

use App\Http\Controllers\Api\FavoritoController;
use App\Http\Controllers\Api\UsuarioController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('usuarios')->group(function () {
    Route::post('/login', [UsuarioController::class, 'login']);
    Route::post('/register', [UsuarioController::class, 'register']);
    Route::get('/{id}', [UsuarioController::class, 'show']);
    Route::post('/update', [UsuarioController::class, 'update']);
    Route::post('/logout', [UsuarioController::class, 'logout']);
});

Route::prefix('favoritos')->group(function () {
    Route::get('/{id}', [FavoritoController::class, 'show']);
    Route::post('/register', [FavoritoController::class, 'store']);
});

