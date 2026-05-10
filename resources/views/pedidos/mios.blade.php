<!DOCTYPE html>
<html>
<head>
    <title>Mis pedidos</title>

    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fff3e0;">

<div class="container mt-5">

    <h1 class="text-center mb-4">
        🧾 Mis pedidos
    </h1>

    <div class="text-center mb-4">
        <a href="/productos" class="btn btn-warning">
            ← Volver
        </a>
    </div>

    @if($pedidos->count() == 0)

        <div class="alert alert-info">
            No tienes pedidos todavía
        </div>

    @endif

    @foreach($pedidos as $pedido)

        <div class="card p-3 mb-3">

            <h4>Pedido #{{ $pedido->id }}</h4>

            <p>
                Estado:
                <strong>{{ $pedido->estado }}</strong>
            </p>

            @php
                $productos = json_decode($pedido->productos, true);
            @endphp

            @if(is_array($productos))

                <ul>

                    @foreach($productos as $producto)

                        <li>

                            @if(isset($producto['nombre']))
                                🍹 {{ $producto['nombre'] }}
                            @else
                                Producto
                            @endif

                        </li>

                    @endforeach

                </ul>

            @else

                <p>No se pudieron cargar productos</p>

            @endif

        </div>

    @endforeach

</div>

</body>
</html>