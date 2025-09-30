@extends('layouts.app')

@section('title', 'Actualizar Ticket')

@section('content')
<h1 class="mb-4">Ticket #{{ $ticket->id }}</h1>

<div class="mb-3">
    <strong>Cliente:</strong> {{ $ticket->cliente->nombre }} <br>
    <strong>Asunto:</strong> {{ $ticket->asunto }} <br>
    <strong>Descripción:</strong> {{ $ticket->descripcion }}
</div>

<div class="mb-3">
    <strong>Estado actual:</strong>
    <span class="badge 
        @if($ticket->estado == 'nuevo') bg-primary 
        @elseif($ticket->estado == 'en_proceso') bg-warning text-dark
        @elseif($ticket->estado == 'en_espera') bg-info
        @elseif($ticket->estado == 'resuelto') bg-success
        @elseif($ticket->estado == 'cerrado') bg-secondary
        @endif">
        {{ ucfirst(str_replace('_',' ',$ticket->estado)) }}
    </span>
</div>

<div class="mb-3">
    <h5>Adjuntos del cliente:</h5>
    @forelse($ticket->adjuntos as $adjunto)
        <a href="{{ asset('storage/'.$adjunto->archivo_url) }}" target="_blank" class="d-block">
            📎 {{ basename($adjunto->archivo_url) }}
        </a>
    @empty
        <p>No hay adjuntos.</p>
    @endforelse
</div>

<form method="POST" action="{{ route('tecnico.tickets.update', $ticket->id) }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Cambiar Estado</label>
        <select name="estado" class="form-select" required>
            <option value="en_proceso" {{ $ticket->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
            <option value="en_espera" {{ $ticket->estado == 'en_espera' ? 'selected' : '' }}>En Espera</option>
            <option value="resuelto" {{ $ticket->estado == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
            <option value="cerrado" {{ $ticket->estado == 'cerrado' ? 'selected' : '' }}>Cerrado</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Actualizar Estado</button>
</form>

<hr>

<h4>Comentarios</h4>
<div class="mb-3">
    @forelse($ticket->comentarios as $comentario)
        <div class="border p-2 mb-2 {{ $comentario->usuario->rol == 'tecnico' ? 'bg-light' : '' }}">
            <strong>{{ $comentario->usuario->nombre }} ({{ ucfirst($comentario->usuario->rol) }}):</strong> 
            {{ $comentario->mensaje }}
            <br>
            <small class="text-muted">{{ $comentario->created_at->format('d/m/Y H:i') }}</small>
        </div>
    @empty
        <p>No hay comentarios aún.</p>
    @endforelse
</div>

<form method="POST" action="{{ route('tecnico.tickets.comentar', $ticket->id) }}">
    @csrf
    <div class="mb-3">
        <textarea name="mensaje" class="form-control" placeholder="Escribe un comentario..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Comentario</button>
</form>

<a href="{{ route('tecnico.tickets.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection