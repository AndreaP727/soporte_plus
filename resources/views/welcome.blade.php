<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SoportePlus - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #424242;
            color: #fff;
            font-family: 'Nunito', sans-serif;
        }
        .card {
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 8px 20px rgba(0,0,0,0.3);
        }
        .role-title {
            font-size: 1.3rem;
            font-weight: bold;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container text-center">
        <h1 class="mb-5 fw-bold">Bienvenido a SoportePlus</h1>
        <p class="mb-5">Selecciona tu tipo de usuario para ingresar</p>

        <div class="row g-4 justify-content-center">
            <!-- Admin -->
            <div class="col-md-3">
                <div class="card" style="background-color:#E0E0E0; color:#424242;">
                    <div class="card-body">
                        <div class="role-title mb-3">Administrador</div>
                        <p class="mb-3">Gestión de tickets, usuarios y reportes.</p>
                        <a href="{{ route('login', ['rol' => 'admin']) }}" class="btn btn-dark fw-bold">Ingresar</a>
                    </div>
                </div>
            </div>

            <!-- Técnico -->
            <div class="col-md-3">
                <div class="card" style="background-color:#FF9800; color:#424242;">
                    <div class="card-body">
                        <div class="role-title mb-3">Técnico</div>
                        <p class="mb-3">Revisa y resuelve los tickets asignados.</p>
                        <a href="{{ route('login', ['rol' => 'tecnico']) }}" class="btn btn-dark fw-bold">Ingresar</a>
                    </div>
                </div>
            </div>

            <!-- Cliente -->
            <div class="col-md-3">
                <div class="card" style="background-color:#FFC107; color:#424242;">
                    <div class="card-body">
                        <div class="role-title mb-3">Cliente</div>
                        <p class="mb-3">Crea y consulta el estado de tus tickets.</p>
                        <a href="{{ route('login', ['rol' => 'cliente']) }}" class="btn btn-dark fw-bold">Ingresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>