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


// PRODUCTOS

Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

Route::get('/categoria/{id}', [ProductoController::class, 'categoria']);

Route::get('/comprar/{id}', [ProductoController::class, 'comprar'])->middleware('auth');

Route::get('/eliminar/{index}', [ProductoController::class, 'eliminar']);

Route::get('/confirmar', [ProductoController::class, 'confirmar'])->middleware('auth');


// PEDIDOS

Route::get('/pedidos', [ProductoController::class, 'pedidos']);

Route::get('/pedido/estado/{id}/{estado}', [ProductoController::class, 'cambiarEstado']);

Route::get('/pedido/eliminar/{id}', [ProductoController::class, 'eliminarPedido']);


// CATEGORÍAS ADMIN

Route::get('/admin/categorias', [ProductoController::class, 'categoriasAdmin']);

Route::post('/admin/categorias/{id}', [ProductoController::class, 'actualizarCategorias']);


// CAMBIO DE IDIOMA

Route::get('/lang/{locale}', function ($locale) {

    if (in_array($locale, ['es', 'en'])) {

        session()->put('locale', $locale);

        if (auth()->check()) {

            $user = auth()->user();

            $user->idioma = $locale;

            $user->save();

        }

    }

    return redirect()->back();

});

Route::get('/mis-pedidos', [ProductoController::class, 'misPedidos'])->middleware('auth');

Route::get('/mi-perfil', function () {
    return view('perfil.index');
})->middleware('auth');

Route::get('/direcciones', [ProductoController::class, 'direcciones'])->middleware('auth');

Route::post('/direcciones', [ProductoController::class, 'guardarDireccion'])->middleware('auth');

Route::get('/direccion/eliminar/{id}', [ProductoController::class, 'eliminarDireccion'])->middleware('auth');

Route::get('/favorito/{id}', [ProductoController::class, 'favorito'])->middleware('auth');

Route::get('/favoritos', [ProductoController::class, 'favoritos'])->middleware('auth');

Route::get('/admin/favoritos', [ProductoController::class, 'favoritosAdmin']);

require __DIR__.'/auth.php';