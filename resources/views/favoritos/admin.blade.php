<!DOCTYPE html>
<html>
<head>
    <title>Favoritos admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#fff3e0;">

<div class="container mt-5">

    <h1 class="mb-4 text-center">
        ⭐ Productos favoritos
    </h1>

    <a href="/productos" class="btn btn-warning mb-4">
        ← Volver
    </a>

    @foreach($productos as $producto)

        @php
            $total = \App\Models\Favorito::where('producto_id', $producto->id)->count();
        @endphp

        <div class="card p-3 mb-3">

            <h4>
                🍹 {{ $producto->nombre }}
            </h4>

            <p>
                Veces marcado como favorito:
                <strong>{{ $total }}</strong>
            </p>

        </div>

    @endforeach

</div>

</body>
</html>