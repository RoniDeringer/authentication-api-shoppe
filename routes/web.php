<?php

use App\Http\Controllers\ApiShopeeController;
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
})->name('home');

Route::get('/formulario', [FormularioController::class, 'index'])->name('formulario');
Route::post('/formulario-add', [FormularioController::class, 'store'])->name('formulario-store');

Route::get('/api-shopee', [ApiShopeeController::class, 'index'])->name('api-shopee');


/**
    * 1 - Localizar a documentação de integração da API da Shoppe.
    * 2 - Criar uma rotina de autenticação com a API deles (nao precisa funcionar, apenas para servir de base)
    * 3 - Pegue um produto qualquer em nosso site e tente postar esse produto na usando a api deles.
    *      Não precisa de fato postar, apenas que a API retorne o erro e que seu código saiba capturar o erro.
 */