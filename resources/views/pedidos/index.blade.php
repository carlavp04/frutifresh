<!DOCTYPE html> 
<html>
<head>
    <title>Pedidos - FrutiFresh 🍊</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff3e0;
        }

        .titulo {
            color: #ff6f00;
            text-align: center;
            margin: 20px;
        }

        .pedido {
            background: white;
            border: 2px solid #ff9800;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .pedido h4 {
            color: #e65100;
        }

        .estado {
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1 class="titulo">🧾 Pedidos realizados</h1>


<div class="text-center mb-3">
    <a href="/productos" class="btn btn-warning">← Volver a la tienda</a>
</div>

<div class="container">

@foreach($pedidos as $pedido)
    <div class="pedido">
        <h4>Pedido #{{ $pedido->id }}</h4>

        <!-- ESTADO MEJORADO -->
        <div class="estado">
            @if($pedido->estado == 'pendiente')
                <span class="badge bg-warning text-dark">⏳ Pendiente</span>
            @elseif($pedido->estado == 'preparando')
                <span class="badge bg-info text-dark">🧃 Preparando</span>
            @elseif($pedido->estado == 'en_camino')
                <span class="badge bg-primary">🚚 En camino</span>
            @else
                <span class="badge bg-success">✅ Completado</span>
            @endif
        </div>

        <!-- BOTONES ADMIN -->
       <div class="mb-2">

        @if($pedido->estado == 'pendiente')
            <a href="/pedido/estado/{{ $pedido->id }}/preparando" class="btn btn-info btn-sm">
                Preparando
            </a>
        @elseif($pedido->estado == 'preparando')
            <a href="/pedido/estado/{{ $pedido->id }}/en_camino" class="btn btn-primary btn-sm">
                En camino
            </a>
        @elseif($pedido->estado == 'en_camino')
            <a href="/pedido/estado/{{ $pedido->id }}/completado" class="btn btn-success btn-sm">
                Completado
            </a>
        @endif

    <!-- SIEMPRE SE PUEDE ELIMINAR -->
        <a href="/pedido/eliminar/{{ $pedido->id }}" class="btn btn-danger btn-sm">
            Eliminar
        </a>

        </div>

        @php
            $productos = json_decode($pedido->productos);
        @endphp

        <ul>
            @foreach($productos as $producto)
                <li>🍹 {{ $producto->nombre }} - {{ $producto->precio }} €</li>
            @endforeach
        </ul>
    </div>
@endforeach

</div>

</body>
</html>