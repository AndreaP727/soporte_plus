<!-- resources/views/tickets/show.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Ticket #{{ $ticket->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

    <h1 class="mb-4">Detalle del Ticket #{{ $ticket->id }}</h1>

    <div class="card mb-4">
        <div class="card-header">
            <strong>{{ $ticket->titulo }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $ticket->descripcion }}</p>
            <p><strong>Cliente:</strong> {{ $ticket->cliente->nombre }}</p>
            <p><strong>Técnico:</strong> {{ $ticket->tecnico->nombre ?? 'Sin asignar' }}</p>
            <p><strong>Estado:</strong> 
                <span class="badge bg-info">{{ ucfirst($ticket->estado) }}</span>
            </p>
            <p><strong>Prioridad:</strong> 
                <span class="badge 
                    @if($ticket->prioridad == 'alta') bg-danger 
                    @elseif($ticket->prioridad == 'media') bg-warning text-dark 
                    @else bg-success @endif">
                    {{ ucfirst($ticket->prioridad) }}
                </span>
            </p>
            <p><strong>Fecha de creación:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Adjuntos -->
    <h3>Archivos adjuntos</h3>
    <ul>
        @forelse($ticket->adjuntos as $adjunto)
            <li><a href="{{ asset('storage/'.$adjunto->archivo_url) }}" target="_blank">📎 Ver archivo</a></li>
        @empty
            <li>No hay adjuntos</li>
        @endforelse
    </ul>

    <!-- Comentarios -->
    <h3 class="mt-4">Comentarios</h3>
    <ul class="list-group mb-3">
        @forelse($ticket->comentarios as $comentario)
            <li class="list-group-item">
                <strong>{{ $comentario->usuario->nombre }}:</strong>
                {{ $comentario->mensaje }}
                <br>
                <small class="text-muted">{{ $comentario->created_at->format('d/m/Y H:i') }}</small>
            </li>
        @empty
            <li class="list-group-item">No hay comentarios aún</li>
        @endforelse
    </ul>

    <!-- Formulario para agregar comentario -->
    <h4>Agregar comentario</h4>
    <form method="POST" action="{{ url('/tickets/'.$ticket->id.'/comentarios') }}">
        @csrf
        <input type="hidden" name="autor" value="3"> <!-- Cliente de prueba -->
        <div class="mb-3">
            <textarea name="mensaje" class="form-control" placeholder="Escribe tu comentario..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <br>
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">⬅ Volver a lista</a>

</body>
</html>