<?php

use App\Http\Controllers\ApiShoppeController;
use App\Http\Controllers\FormularioController;
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

Route::get('/formulario', [FormularioController::class, 'index'])->name('formulario');
Route::post('/formulario-add', [FormularioController::class, 'store'])->name('formulario-store');

Route::get('/api-shoppe', [ApiShoppeController::class, 'index'])->name('api-shoppe');
