<!DOCTYPE html>
<html>
<head>
    <title>Mis favoritos</title>

    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fff3e0;">

<div class="container mt-5">

    <h1 class="text-center mb-5">
        ❤️ Mis productos favoritos
    </h1>

    <div class="row">

        @foreach($productos as $producto)

            <div class="col-md-4 mb-4">

                <div class="card p-3 shadow">

                    <h4>
                        🍹 {{ $producto->nombre }}
                    </h4>

                    <p>
                        {{ $producto->descripcion }}
                    </p>

                    <p>
                        <strong>
                            {{ $producto->precio }} €
                        </strong>
                    </p>

                    <a href="/favorito/{{ $producto->id }}"
                       class="btn btn-dark">

                        ❤️ Quitar favorito

                    </a>

                </div>

            </div>

        @endforeach

    </div>

    @if(count($productos) == 0)

        <div class="alert alert-warning text-center">

            No tienes favoritos todavía.

        </div>

    @endif

    <div class="text-center mt-4">

        <a href="/mi-perfil" class="btn btn-warning">

            ← Volver al perfil

        </a>

    </div>

</div>

</body>
</html>