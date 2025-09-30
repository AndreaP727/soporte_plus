@extends('layouts.app')

@section('title', 'Detalle Ticket')

@section('content')
<h1 class="mb-4">Ticket #{{ $ticket->id }}</h1>

<!-- Información principal -->
<div class="mb-3">
    <strong>Asunto:</strong> {{ $ticket->asunto }} <br>
    <strong>Categoría:</strong> {{ $ticket->categoria }} <br>
    <strong>Prioridad:</strong> {{ ucfirst($ticket->prioridad) }} <br>
    <strong>Estado:</strong> {{ ucfirst(str_replace('_',' ',$ticket->estado)) }} <br>
    <strong>Descripción:</strong> {{ $ticket->descripcion }}
</div>

<!-- Adjuntos -->
<div class="mb-3">
    <h5>📎 Archivos Adjuntos</h5>
    @forelse($ticket->adjuntos as $adjunto)
        <a href="{{ asset('storage/'.$adjunto->archivo_url) }}" target="_blank" class="d-block">
            📂 {{ basename($adjunto->archivo_url) }}
        </a>
    @empty
        <p>No hay adjuntos.</p>
    @endforelse
</div>

<hr>

<!-- Conversación -->
<h4>💬 Conversación</h4>
<div class="mb-3">
    @forelse($ticket->comentarios as $comentario)
        <div class="border p-2 mb-2 rounded @if($comentario->usuario->rol === 'tecnico') bg-light @endif">
            <strong>{{ $comentario->usuario->nombre }} ({{ ucfirst($comentario->usuario->rol) }}):</strong>
            <p class="mb-1">{{ $comentario->mensaje }}</p>
            <small class="text-muted">{{ $comentario->created_at->format('d/m/Y H:i') }}</small>
        </div>
    @empty
        <p>No hay comentarios aún.</p>
    @endforelse
</div>

<!-- Formulario para responder -->
<form method="POST" action="{{ route('cliente.tickets.comentar', $ticket->id) }}">
    @csrf
    <div class="mb-3">
        <textarea name="mensaje" class="form-control" placeholder="Escribe tu respuesta..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar Comentario</button>
    <a href="{{ route('cliente.tickets.index') }}" class="btn btn-secondary">Volver</a>
</form>

<hr>

<!-- Calificación de satisfacción -->
@if($ticket->estado == 'resuelto' && !$ticket->satisfaccion)
    <h4 class="mt-4">⭐ Califica el servicio</h4>
    <form method="POST" action="{{ route('cliente.tickets.calificar', $ticket->id) }}">
        @csrf
        <div class="mb-3">
            <select name="satisfaccion" class="form-select w-25" required>
                <option value="">Selecciona...</option>
                <option value="1">⭐ Malo</option>
                <option value="2">⭐⭐ Regular</option>
                <option value="3">⭐⭐⭐ Aceptable</option>
                <option value="4">⭐⭐⭐⭐ Bueno</option>
                <option value="5">⭐⭐⭐⭐⭐ Excelente</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enviar Calificación</button>
    </form>
@elseif($ticket->satisfaccion)
    <h4 class="mt-4">⭐ Tu Calificación</h4>
    <p class="fs-5">{{ $ticket->satisfaccion }} / 5 estrellas</p>
@endif

@endsection
