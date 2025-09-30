<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - SoportePlus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Registro de Usuario</h2>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Formulario --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nombre --}}
            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Correo --}}
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required>
                @error('correo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Contraseña --}}
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
                @error('contrasena') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Rol --}}
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    <option value="tecnico" {{ old('rol') == 'tecnico' ? 'selected' : '' }}>Técnico</option>
                    <option value="cliente" {{ old('rol') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                </select>
                @error('rol') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Botón --}}
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>

        {{-- Link al login --}}
        <div class="mt-3 text-center">
            <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>

</body>
</html>