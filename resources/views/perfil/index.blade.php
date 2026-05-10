<!DOCTYPE html>
<html>
<head>
    <title>Mi perfil</title>

    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#fff3e0;">

<div class="container mt-5">

    <h1 class="text-center mb-5">
        👤 {{ __('messages.perfil_title') }}
    </h1>

    <div class="row">


        <div class="col-md-6 mb-4">

            <div class="card p-4 shadow">

                <h4>❤️  {{ __('messages.fav_title') }}</h4>

                <p>
                    {{ __('messages.fav_text') }}
                </p>

                <a href="/favoritos" class="btn btn-danger">

                    {{ __('messages.see_favs') }}

                </a>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card p-4 shadow">

                <h4>📍 {{ __('messages.address_title') }}</h4>

                <p>
                    {{ __('messages.address_text') }}
                </p>

                <a href="/direcciones" class="btn btn-info">
                    {{ __('messages.see_address') }}

                </a>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card p-4 shadow">

                <h4>📦 {{ __('messages.orders_title') }}</h4>

                <p>
                    {{ __('messages.orders_text') }}
                </p>

                <a href="/mis-pedidos" class="btn btn-warning">
                    {{ __('messages.see_orders') }}
                </a>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card p-4 shadow">

                <h4>🌍 {{ __('messages.language_title') }}</h4>

                <p>
                    {{ __('messages.language_text') }}
                </p>

                <a href="/lang/es"
                    class="btn {{ auth()->user()->idioma == 'es'
                        ? 'btn-success border border-4 border-dark'
                        : 'btn-outline-success' }}">

                    🇪🇸 Español

                </a>

                <a href="/lang/en"
                    class="btn {{ auth()->user()->idioma == 'en'
                        ? 'btn-primary border border-4 border-dark'
                        : 'btn-outline-primary' }}">

                    🇬🇧 English

                </a>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card p-4 shadow">

                <h4>⚙️ {{ __('messages.edit_title') }}</h4>

                <p>
                    {{ __('messages.edit_text') }}
                </p>

                <a href="/profile" class="btn btn-dark">
                    {{ __('messages.edit_button') }}
                </a>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card p-4 shadow">

                <h4>🚪 {{ __('messages.logout_title') }}</h4>

                <p>
                    {{ __('messages.logout_text') }}
                </p>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="btn btn-danger">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

    <div class="text-center mt-4">

        <a href="/productos" class="btn btn-warning">
            ← {{ __('messages.back_store') }}
        </a>

    </div>

</div>

</body>
</html>