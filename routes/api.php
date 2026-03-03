<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComunaController;

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

// La ruta que usará el fetch de tu JavaScript
Route::get('/comunas/{region_id}', [ComunaController::class, 'getByRegion']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/comunas-por-region/{region_id}', function ($region_id) {
    return \App\Models\Comuna::where('region_id', $region_id)->get();
});