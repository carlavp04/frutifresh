<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
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

    public function confirmar()
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect('/productos');
        }

        // guardar pedido
        $pedido = Pedido::create([
            'productos' => json_encode($carrito),
            'estado' => 'pendiente'
        ]);

        // 🔥 EMAIL (básico)
        try {
            Mail::raw('Tu pedido #' . $pedido->id . ' ha sido realizado correctamente 🍊', function ($message) {
                $message->to('test@test.com')
                        ->subject('Pedido confirmado - FrutiFresh');
            });
        } catch (\Exception $e) {
            // si falla el email, no pasa nada
        }

        session()->forget('carrito');

        return redirect('/productos')->with('success', 'Pedido realizado correctamente');
    }

    public function pedidos(){
        if (!Auth::check() || Auth::user()->email != 'admin@admin.com') {
            session()->flash('error', 'Solo los administradores pueden acceder a esta sección');
            return redirect('/productos');
        }

        $pedidos = Pedido::all();

        return view('pedidos.index', compact('pedidos'));
    }



    public function cambiarEstado($id, $estado){
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

    public function eliminarPedido($id){
        if (!auth()->check() || auth()->user()->email != 'admin@admin.com') {
            return redirect('/productos');
        }

        $pedido = Pedido::find($id);

        if ($pedido) {
            $pedido->delete();
        }

        return redirect('/pedidos');
    }
}