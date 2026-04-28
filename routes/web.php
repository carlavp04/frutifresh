<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/productos', [ProductoController::class, 'index'])->name('productos');
Route::get('/comprar/{id}', [ProductoController::class, 'comprar'])->middleware('auth');
Route::get('/eliminar/{index}', [ProductoController::class, 'eliminar']);
Route::get('/confirmar', [ProductoController::class, 'confirmar'])->middleware('auth');
Route::get('/pedidos', [ProductoController::class, 'pedidos']);
Route::get('/pedido/estado/{id}/{estado}', [ProductoController::class, 'cambiarEstado']);
Route::get('/pedido/eliminar/{id}', [ProductoController::class, 'eliminarPedido']);

require __DIR__.'/auth.php';