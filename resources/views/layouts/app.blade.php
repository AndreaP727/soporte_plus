<!DOCTYPE html>   
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SoportePlus')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
        <div class="container-fluid">

            <!-- Logo/redirección según el rol -->
            @php
                if (session('rol') === 'cliente') {
                    $logoRoute = route('cliente.tickets.index');
                } elseif (session('rol') === 'tecnico') {
                    $logoRoute = route('tecnico.tickets.index');
                } elseif (session('rol') === 'admin') {
                    $logoRoute = route('admin.dashboard');
                } else {
                    $logoRoute = route('home');
                }
            @endphp

            <a class="navbar-brand" href="{{ $logoRoute }}">SoportePlus</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(session()->has('usuario_id'))
                        <li class="nav-item">
                            <span class="nav-link">
                                👤 {{ session('nombre') }} ({{ ucfirst(session('rol')) }})
                            </span>
                        </li>

                        <!-- Botón logout -->
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ms-2">Cerrar sesión</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Registrarse</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO -->
    <div class="container-fluid">
        <div class="row">
            
            <!-- Sidebar SOLO para admin -->
            @if(session('rol') === 'admin')
                <div class="col-md-3 col-lg-2 bg-light border-end vh-100 p-3">
                    <h5>📊 Panel Admin</h5>
                    <div class="list-group">
                        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">📈 Dashboard</a>
                        <a href="{{ route('admin.tickets.index') }}" class="list-group-item list-group-item-action">🎫 Gestión de Tickets</a>
                        <a href="{{ route('admin.usuarios.index') }}" class="list-group-item list-group-item-action">👥 Gestión de Usuarios</a>
                        <a href="{{ route('admin.reportes.csv') }}" class="list-group-item list-group-item-action">⬇️ Exportar CSV</a>
                        <a href="{{ route('admin.reportes.pdf') }}" class="list-group-item list-group-item-action">⬇️ Exportar PDF</a>
                        <a href="{{ route('admin.reportes.excel') }}" class="list-group-item list-group-item-action">⬇️ Exportar Excel</a>
                    </div>
                </div>
                <div class="col-md-9 col-lg-10 p-4">
                    @yield('content')
                </div>
            @else
                <!-- Vista normal para cliente/técnico -->
                <div class="col-12 p-4">
                    @yield('content')
                </div>
            @endif

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>