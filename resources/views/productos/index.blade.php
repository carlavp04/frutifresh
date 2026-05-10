<!DOCTYPE html> 
<html>
<head>
    <title>FrutiFresh 🍊</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
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

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/productos">🍊 FrutiFresh</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="/productos">{{ __('messages.store') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/lang/es">ES</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/lang/en">EN</a>
        </li>

        @if(auth()->check() && auth()->user()->email == 'admin@admin.com')

            <li class="nav-item">
                <a class="nav-link" href="/pedidos">
                    {{ __('messages.orders') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/categorias">
                    {{ __('messages.categories') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/favoritos">
                    ⭐ {{ __('messages.favs') }}
                </a>
            </li>

        @endif

        @if(auth()->check() && auth()->user()->email != 'admin@admin.com')

            <li class="nav-item">
                <a class="nav-link" href="/mis-pedidos">
                    Mis pedidos
                </a>
            </li>

        @endif


            <li class="nav-item">
                <a class="nav-link" href="/mi-perfil">
                    {{ __('messages.perfil') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#contacto">
                    {{ __('messages.contact') }}</a>
            </li>

      </ul>
    </div>
  </div>
</nav>

<!-- HEADER -->
<div class="text-center">
    <img src="https://images.unsplash.com/photo-1553530666-ba11a7da3888"
         style="width:100%; max-height:300px; object-fit:cover;">
</div>

<h1 class="titulo">🍊 {{ __('messages.title') }}</h1>


<!-- FILTRO CATEGORÍAS -->
<div class="text-center mb-4">

    <a href="/productos"
       class="btn {{ $categoriaActual == null ? 'btn-dark' : 'btn-success' }} btn-sm">
        {{ __('messages.all') }}
    </a>

    @foreach($categorias as $categoria)

        <a href="/categoria/{{ $categoria->id }}"
           class="btn {{ $categoriaActual == $categoria->id ? 'btn-dark' : 'btn-success' }} btn-sm">

            @if($categoria->nombre == 'Frutas')
                {{ __('messages.fruits') }}

            @elseif($categoria->nombre == 'Detox')
                {{ __('messages.detox') }}

            @elseif($categoria->nombre == 'Tropical')
                {{ __('messages.tropical') }}

            @elseif($categoria->nombre == 'Smoothie')
                {{ __('messages.smoothie') }}

            @elseif($categoria->nombre == 'Saludable')
                {{ __('messages.healthy') }}

            @elseif($categoria->nombre == 'Energético')
                {{ __('messages.energy') }}

            @elseif($categoria->nombre == 'Vegetales')
                {{ __('messages.vegetables') }}

            @else
                {{ $categoria->nombre }}
            @endif

        </a>

    @endforeach

</div>

<!-- MENSAJES -->
@if(session('error'))
    <div id="mensaje-error" style="background-color:#f44336; color:white; padding:10px; text-align:center; margin:10px;">
        {{ session('error') }}
    </div>
@endif

<!-- CARRITO -->
<div class="container mt-4">

<h2 class="text-center mb-3">🛒{{ __('messages.cart') }}</h2>

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
            {{ __('messages.confirm') }}
        </a>
    </div>

@else
    <p class="text-center text-muted">{{ __('messages.empty') }}</p>
@endif

</div>

<!-- PRODUCTOS -->
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
                        <img src="https://thumbs.dreamstime.com/b/c%C3%B3ctel-de-verano-con-zumo-pi%C3%B1a-vodka-mango-bebida-larga-o-cola-fr%C3%ADa-salpicaduras-congeladas-y-ca%C3%ADdas-voladoras-tropical-fondo-241835244.jpg?w=576" class="card-img-top mb-2">

                    @elseif(str_contains(strtolower($producto->nombre), 'energético'))
                        <img src="https://glamour-fresh.com/wp-content/uploads/2021/12/batido-mango-glamour-fresh.webp" class="card-img-top mb-2">

                    @elseif(str_contains(strtolower($producto->nombre), 'smoothie'))
                        <img src="https://okdiario.com/img/recetas/2017/07/04/smoothie-de-frutos-rojos.jpg" class="card-img-top mb-2">

                    @elseif(str_contains(strtolower($producto->nombre), 'verde'))
                        <img src="https://cdn7.kiwilimon.com/recetaimagen/20472/640x426/14858.jpg.webp" class="card-img-top mb-2">

                    @else
                        <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e" class="card-img-top mb-2">
                    @endif

                    <h4>🍹 {{ $producto->nombre }}</h4>

                    @if(str_contains(strtolower($producto->nombre), 'naranja'))
                        <p>🍊 {{ __('messages.orange_desc') }}</p>

                    @elseif(str_contains(strtolower($producto->nombre), 'detox'))
                        <p>🥬 {{ __('messages.detox_desc') }}</p>

                    @elseif(str_contains(strtolower($producto->nombre), 'tropical'))
                        <p>🍍 {{ __('messages.tropical_desc') }}</p>

                    @elseif(str_contains(strtolower($producto->nombre), 'energético'))
                        <p>⚡ {{ __('messages.energy_desc') }}</p>

                    @elseif(str_contains(strtolower($producto->nombre), 'smoothie'))
                        <p>🍓 {{ __('messages.smoothie_desc') }}</p>

                    @elseif(str_contains(strtolower($producto->nombre), 'verde'))
                        <p>🥦 {{ __('messages.green_desc') }}</p>

                    @else
                        <p>{{ $producto->descripcion }}</p>
                    @endif

                    <p><strong>{{ $producto->precio }} €</strong></p>

                    <!-- CATEGORÍAS -->
                    <div class="mb-2">

                        @foreach($producto->categorias as $cat)

                            <span class="badge bg-success">
                                @if($cat->nombre == 'Frutas')
                                    {{ __('messages.fruits') }}

                                @elseif($cat->nombre == 'Detox')
                                    {{ __('messages.detox') }}

                                @elseif($cat->nombre == 'Tropical')
                                    {{ __('messages.tropical') }}

                                @elseif($cat->nombre == 'Smoothie')
                                    {{ __('messages.smoothie') }}

                                @elseif($cat->nombre == 'Saludable')
                                    {{ __('messages.healthy') }}

                                @elseif($cat->nombre == 'Energético')
                                    {{ __('messages.energy') }}

                                @elseif($cat->nombre == 'Vegetales')
                                    {{ __('messages.vegetables') }}

                                @else
                                    {{ $cat->nombre }}
                                @endif
                            </span>

                        @endforeach

                    </div>

                    @if(in_array($producto->id, $favoritos))

                        <a href="/favorito/{{ $producto->id }}"
                            class="btn btn-dark mb-2">

                            ❤️ {{ __('messages.removefav') }}

                        </a>

                    @else

                        <a href="/favorito/{{ $producto->id }}"
                            class="btn btn-danger mb-2">

                            🤍 {{ __('messages.addfav') }}

                        </a>

                    @endif

                    <a href="/comprar/{{ $producto->id }}" class="btn btn-comprar">
                        {{ __('messages.buy') }}
                    </a>

                </div>
            </div>
        @endforeach

    </div>
</div>

<!-- FOOTER -->
<footer id="contacto">
    <h5>{{ __('messages.contact') }}</h5>
    <p>Email: frutifresh@gmail.com</p>
    <p>Teléfono: 123 456 789</p>
</footer>

<!-- SCRIPT -->
<script>
    setTimeout(function() {
        let mensajeError = document.getElementById('mensaje-error');

        if (mensajeError) {
            mensajeError.style.display = 'none';
        }
    }, 3000);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>