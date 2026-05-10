<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>

    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fff3e0;">

<div class="container mt-5">

    <h1 class="text-center mb-5">
        🗂️ Gestión de categorías
    </h1>

        <div class="text-center mb-4">

            <a href="/productos" class="btn btn-warning">

                ← Volver a tienda

            </a>

        </div>

    @foreach($productos as $producto)

        <div class="card p-4 mb-4 shadow">

            <h4>
                🍹 {{ $producto->nombre }}
            </h4>

            <form method="POST" action="/admin/categorias/{{ $producto->id }}">

                @csrf

                @foreach($categorias as $categoria)

                    <div class="form-check">

                        <input
                            type="checkbox"
                            name="categorias[]"
                            value="{{ $categoria->id }}"
                            class="form-check-input"

                            @if($producto->categorias->contains($categoria->id))
                                checked
                            @endif
                        >

                        <label class="form-check-label">

                            {{ $categoria->nombre }}

                        </label>

                    </div>

                @endforeach

                <button class="btn btn-success mt-3">

                    Guardar categorías

                </button>

            </form>

        </div>

    @endforeach

</div>

</body>
</html>