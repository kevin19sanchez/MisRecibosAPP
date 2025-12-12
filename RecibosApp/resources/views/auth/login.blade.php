<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - RecibosApp</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center min-vh-100">

    <div class="bg-dark text-white p-4 p-md-5 rounded shadow" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <div class="bg-primary rounded d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                <i class="fas fa-check text-white fs-1"></i>
            </div>
            <h3 class="mt-3 mb-1">RecibosApp</h3>
            <p class="text-light">Gestiona tus facturas fácilmente</p>
        </div>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar Sesión</button>

            <p class="text-center text-white mb-0">
                ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                    Regístrate aquí
                </a>
            </p>
        </form>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
