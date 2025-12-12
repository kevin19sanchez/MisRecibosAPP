<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - RecibosApp</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center min-vh-100">

    <div class="bg-dark text-white p-4 p-md-5 rounded shadow" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <h3 class="mb-1">Crear Cuenta</h3>
            <p class="text-light">Únete a RecibosApp hoy</p>
        </div>

        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('mensaje') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('create.register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control bg-dark text-white border-secondary" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Crear Cuenta</button>

            <p class="text-center text-white mb-0">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                    Inicia sesión
                </a>
            </p>
        </form>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
