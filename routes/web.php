<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/transferencia/cuentas-propias', [App\Http\Controllers\TransferenciaController::class, 'cuentasPropias'])->name('cuentas.propias');
    Route::post('/transferencia/realizar', [App\Http\Controllers\TransferenciaController::class, 'realizarTransferencia'])->name('transferencia.realizar');
    
    // Rutas para cuentas de terceros
    Route::get('/cuentas-terceros', [App\Http\Controllers\TransferenciaTercerosController::class, 'cuentasTerceros'])->name('cuentas.terceros');
    Route::post('/transferencia/realizar-terceros', [App\Http\Controllers\TransferenciaTercerosController::class, 'realizarTransferencia'])->name('transferencia.terceros.realizar');

    Route::get('/transacciones', [App\Http\Controllers\TransaccionController::class, 'listarTransacciones'])->name('transacciones.listar');
});
