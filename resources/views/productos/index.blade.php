<!DOCTYPE html>
<html>
<head>
    <title>FrutiFresh 🍊</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff3e0;
        }

        .titulo {
            color: #ff6f00;
            text-align: center;
            margin-top: 20px;
        }

        .card {
            border: 2px solid #ff9800;
            border-radius: 10px;
        }

        .btn-comprar {
            background-color: #ff6f00;
            color: white;
        }

        .btn-comprar:hover {
            background-color: #e65100;
        }

        footer {
            background: #333;
            color: white;
            padding: 20px;
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/productos">🍊 FrutiFresh</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
      ☰
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/productos">Tienda</a></li>
        @auth
            @if(Auth::user()->email == 'admin@admin.com')
                <li class="nav-item"><a class="nav-link" href="/pedidos">Pedidos</a></li>
            @else
                <li class="nav-item"><span class="nav-link text-muted">Pedidos (solo admin)</span></li>
            @endif
        @endauth        
        <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="text-center">
    <img src="https://images.unsplash.com/photo-1553530666-ba11a7da3888"
         style="width:100%; max-height:300px; object-fit:cover;">
</div>

<h1 class="titulo">🍊 FrutiFresh - Zumos</h1>
@if(session('error'))
    <div style="background-color:#f44336; color:white; padding:10px; text-align:center; margin:10px;">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div id="mensaje" style="background-color:#ff9800; color:white; padding:10px; text-align:center; margin:10px;">
        {{ session('success') }}
    </div>
@endif

<!-- 🟢 CARRITO ARREGLADO -->
<div class="container mt-4">

<h2 class="text-center mb-3">🛒 Tu carrito</h2>

@php
    $carrito = session('carrito', []);
@endphp

@if(count($carrito) > 0)

    @foreach($carrito as $index => $item)
        <div class="card p-3 mb-2 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">🍹 {{ $item->nombre }}</h5>
                    <p class="mb-0 text-muted">{{ $item->precio }} €</p>
                </div>

                <a href="/eliminar/{{ $index }}" class="btn btn-danger btn-sm">
                    ❌
                </a>
            </div>
        </div>
    @endforeach

    <div class="text-center mt-3">
        <a href="{{ url('/confirmar') }}" class="btn btn-success">
            Confirmar pedido
        </a>
    </div>

@else
    <p class="text-center text-muted">Tu carrito está vacío</p>
@endif

</div>

<div class="container mt-4">
    <div class="row">

        @foreach ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card p-3">

                    @if(str_contains(strtolower($producto->nombre), 'naranja'))
                        <img src="https://libbys.es/wordpress/wp-content/uploads/2019/07/jugonaranja.jpg" class="card-img-top mb-2">
                    @elseif(str_contains(strtolower($producto->nombre), 'detox'))
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTo22VOuzJGnIk-k0n-x9pxzP2gZED3MGpC2A&s" class="card-img-top mb-2">
                    @elseif(str_contains(strtolower($producto->nombre), 'tropical'))
                        <img src="https://www.chefplus.es/sites/default/files/styles/receta__650x345_/public/zumo_de_bayas-shutterstock_280127078.jpg?itok=XR9rBPM8" class="card-img-top mb-2">
                    @else
                        <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e" class="card-img-top mb-2">
                    @endif

                    <h4>🍹 {{ $producto->nombre }}</h4>

                    @if(str_contains(strtolower($producto->nombre), 'naranja'))
                        <p>🍊 Zumo natural recién exprimido, cargado de vitamina C para darte energía desde el primer sorbo.</p>
                    @elseif(str_contains(strtolower($producto->nombre), 'detox'))
                        <p>🥬 Refrescante mezcla detox que limpia tu cuerpo y te hace sentir ligero y lleno de vida.</p>
                    @elseif(str_contains(strtolower($producto->nombre), 'tropical'))
                        <p>🍍 Explosión de sabores tropicales que te transporta directamente a una playa paradisíaca.</p>
                    @else
                        <p>{{ $producto->descripcion }}</p>
                    @endif

                    <p><strong>{{ $producto->precio }} €</strong></p>

                    <a href="/comprar/{{ $producto->id }}" class="btn btn-comprar">
                        Comprar
                    </a>

                </div>
            </div>
        @endforeach

    </div>
</div>

<footer id="contacto">
    <h5>Contacto</h5>
    <p>Email: frutifresh@gmail.com</p>
    <p>Teléfono: 123 456 789</p>
</footer>

<script>
    setTimeout(function() {
        let mensaje = document.getElementById('mensaje');
        if (mensaje) {
            mensaje.style.display = 'none';
        }
    }, 3000);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>