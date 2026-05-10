<!DOCTYPE html>
<html>
<head>
    <title>Mis direcciones</title>

    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fff3e0;">

<div class="container mt-5">

    <h1 class="text-center mb-4">
        📍 Mis direcciones
    </h1>

    <div class="card p-4 mb-4">

        <form method="POST" action="/direcciones">

            @csrf

            <div class="mb-3">
                <label>Calle</label>

                <input type="text"
                       name="calle"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Ciudad</label>

                <input type="text"
                       name="ciudad"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Código postal</label>

                <input type="text"
                       name="codigo_postal"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>País</label>

                <input type="text"
                       name="pais"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-success">
                Guardar dirección
            </button>

        </form>

    </div>

    @foreach($direcciones as $direccion)

        <div class="card p-3 mb-3">

            <h5>{{ $direccion->calle }}</h5>

            <p>
                {{ $direccion->ciudad }}
                -
                {{ $direccion->codigo_postal }}
            </p>

            <p>
                {{ $direccion->pais }}
            </p>

            <a href="/direccion/eliminar/{{ $direccion->id }}"
               class="btn btn-danger">

                Eliminar

            </a>

        </div>

    @endforeach

    <div class="text-center mt-4">

        <a href="/mi-perfil" class="btn btn-warning">
            ← Volver al perfil
        </a>

    </div>

</div>

</body>
</html>