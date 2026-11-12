
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión</title>

    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <div class="login-logo">
            <div class="logo-icon">
                <i>◆</i>
            </div>

            <h1>Bienvenido</h1>
            <p>Ingresa tus credenciales para ingresar a Agrovalle</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.authenticate') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="ejemplo@correo.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Ingresa tu contraseña"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Iniciar sesión
            </button>

        </form>

        <div class="login-footer">
            <p>© {{ date('Y') }} - Sistema de administración</p>
        </div>

    </div>

</div>

</body>
</html>
