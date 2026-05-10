<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categorias')->get();

        $categorias = \App\Models\Categoria::all();

        $categoriaActual = null;

        $favoritos = [];

        if (auth()->check()) {

            $favoritos = \App\Models\Favorito::where('user_id', auth()->id())
                ->pluck('producto_id')
                ->toArray();

        }

        return view('productos.index', compact(
            'productos',
            'categorias',
            'categoriaActual',
            'favoritos'
        ));    
    }

    public function categoria($id)
    {
        $productos = Producto::with('categorias')
            ->whereHas('categorias', function ($query) use ($id) {
                $query->where('categorias.id', $id);
            })
            ->get();

        $categorias = \App\Models\Categoria::all();

        $categoriaActual = $id;

        $favoritos = [];

        if (auth()->check()) {

            $favoritos = \App\Models\Favorito::where('user_id', auth()->id())
                ->pluck('producto_id')
                ->toArray();

        }

        return view('productos.index', compact(
            'productos',
            'categorias',
            'categoriaActual',
            'favoritos'
        ));
    }

    //  PANEL ADMIN CATEGORÍAS
    public function categoriasAdmin()
    {
        if (!auth()->check() || auth()->user()->email != 'admin@admin.com') {
            return redirect('/productos');
        }

        $productos = Producto::with('categorias')->get();

        $categorias = \App\Models\Categoria::all();

        return view('categorias.admin', compact('productos', 'categorias'));
    }

    //  GUARDAR CAMBIOS CATEGORÍAS
    public function actualizarCategorias(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->email != 'admin@admin.com') {
            return redirect('/productos');
        }

        $producto = Producto::find($id);

        if ($producto) {
            $producto->categorias()->sync($request->categorias ?? []);
        }

        return redirect('/admin/categorias');
    }

    public function comprar($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect('/productos');
        }

        $carrito = session()->get('carrito', []);

        $carrito[] = $producto;

        session()->put('carrito', $carrito);

        session()->forget('success');

        return redirect('/productos');
    }

    public function eliminar($index)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$index])) {
            unset($carrito[$index]);
        }

        session()->put('carrito', $carrito);

        session()->forget('success');

        return redirect('/productos');
    }

    public function confirmar(){
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
        return redirect('/productos');
        }

        DB::beginTransaction();

        try {

            // GUARDAR PEDIDO
            $pedido = Pedido::create([
                'productos' => json_encode($carrito),
                'estado' => 'pendiente',
                'user_id' => auth()->id()
            ]);

            // EMAIL
            Mail::raw(
                'Tu pedido #' . $pedido->id . ' ha sido realizado correctamente 🍊',
                function ($message) {
                    $message->to('test@test.com')
                            ->subject('Pedido confirmado - FrutiFresh');
                }
            );

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect('/productos')
                ->with('error', 'Error al confirmar pedido');

        }

        session()->forget('carrito');

        return redirect('/productos')
            ->with('success', 'Pedido realizado correctamente');
    }

    public function pedidos()
    {
        if (!Auth::check() || Auth::user()->email != 'admin@admin.com') {

            session()->flash('error', 'Solo los administradores pueden acceder a esta sección');

            return redirect('/productos');
        }

        $pedidos = Pedido::all();

        return view('pedidos.index', compact('pedidos'));
    }

    public function cambiarEstado($id, $estado)
    {
        if (!auth()->check() || auth()->user()->email != 'admin@admin.com') {
            return redirect('/productos');
        }

        $pedido = Pedido::find($id);

        if ($pedido) {
            $pedido->estado = $estado;
            $pedido->save();
        }

        return redirect('/pedidos');
    }

    public function eliminarPedido($id)
    {
        if (!auth()->check() || auth()->user()->email != 'admin@admin.com') {
            return redirect('/productos');
        }

        $pedido = Pedido::find($id);

        if ($pedido) {
            $pedido->delete();
        }

        return redirect('/pedidos');
    }

    public function misPedidos(){
        if (!auth()->check()) {
            return redirect('/login');
        }

        $pedidos = Pedido::all();
        return view('pedidos.mios', compact('pedidos'));
    }

    public function direcciones(){
        $direcciones = \App\Models\Direccion::where('user_id', auth()->id())->get();

        return view('direcciones.index', compact('direcciones'));
    }

    public function guardarDireccion(Request $request){
        \App\Models\Direccion::create([

            'user_id' => auth()->id(),

            'calle' => $request->calle,

            'ciudad' => $request->ciudad,

            'codigo_postal' => $request->codigo_postal,

            'pais' => $request->pais

        ]);

        return redirect('/direcciones');
    }

    public function eliminarDireccion($id){
        $direccion = \App\Models\Direccion::find($id);

        if ($direccion && $direccion->user_id == auth()->id()) {

            $direccion->delete();

        }

        return redirect('/direcciones');
    }

    public function favorito($id){
        if (!auth()->check()) {
            return redirect('/login');
    }

        $favorito = \App\Models\Favorito::where('user_id', auth()->id())
            ->where('producto_id', $id)
            ->first();

        // SI YA EXISTE → ELIMINAR
        if ($favorito) {

            $favorito->delete();

        } else {

            // SI NO EXISTE → CREAR
            \App\Models\Favorito::create([

                'user_id' => auth()->id(),

                'producto_id' => $id

            ]);

        }

        return redirect()->back();
    }

    public function favoritos(){
        $favoritos = \App\Models\Favorito::where('user_id', auth()->id())
            ->pluck('producto_id');

        $productos = \App\Models\Producto::whereIn('id', $favoritos)->get();

        return view('favoritos.index', compact('productos'));
    }

    public function favoritosAdmin(){

        if (!auth()->check() || auth()->user()->email != 'admin@admin.com') {
            return redirect('/productos');
        }

        $productos = \App\Models\Producto::all();

        return view('favoritos.admin', compact('productos'));
    }

}