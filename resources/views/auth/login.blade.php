<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - SoportePlus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Formulario de login -->
        <form method="POST" action="{{ route('loginUser') }}">
            @csrf

            <!-- Campo oculto para el rol si viene de ?rol= -->
            @if(isset($rol) || request('rol'))
                <input type="hidden" name="rol" value="{{ $rol ?? request('rol') }}">
            @endif

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" required>
                @error('correo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
                @error('contrasena') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Mostrar rol en modo lectura -->
            @if(isset($rol) || request('rol'))
                <div class="mb-3">
                    <label class="form-label">Rol seleccionado</label>
                    <input type="text" class="form-control" value="{{ ucfirst($rol ?? request('rol')) }}" disabled>
                </div>
            @endif

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('home') }}">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>

</body>
</html>
