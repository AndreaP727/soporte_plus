@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<h1 class="mb-4">Gestión de Usuarios</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<!-- Crear nuevo usuario -->
<div class="card mb-4">
    <div class="card-header">Crear Usuario</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.usuarios.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="admin">Administrador</option>
                    <option value="tecnico">Técnico</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Crear</button>
        </form>
    </div>
</div>

<!-- Listado de usuarios -->
<div class="card">
    <div class="card-header">Usuarios Registrados</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td>{{ ucfirst($usuario->rol) }}</td>
                        <td>
                            @if($usuario->rol !== 'admin')
                                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            @else
                                <span class="badge bg-secondary">Protegido</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No hay usuarios registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection