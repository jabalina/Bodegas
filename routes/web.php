<?php
use App\Http\Controllers\BodegaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('bodegas', BodegaController::class);
Route::get('/bodegas/{bodega}/edit', [BodegaController::class, 'edit'])->name('bodegas.edit');
Route::put('/bodegas/{bodega}', [BodegaController::class, 'update'])->name('bodegas.update');