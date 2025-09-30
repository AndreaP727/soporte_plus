@extends('layouts.app')

@section('title', 'Asignar Técnico')

@section('content')
<h1 class="mb-4">Asignar Técnico al Ticket #{{ $ticket->id }}</h1>

<!-- Datos del Ticket -->
<div class="card mb-4">
    <div class="card-body">
        <p><strong>Asunto:</strong> {{ $ticket->asunto }}</p>
        <p><strong>Cliente:</strong> {{ $ticket->cliente->nombre }}</p>
        <p><strong>Estado actual:</strong> 
            <span class="badge 
                @if($ticket->estado == 'nuevo') bg-primary 
                @elseif($ticket->estado == 'en_proceso') bg-warning text-dark
                @elseif($ticket->estado == 'en_espera') bg-info
                @elseif($ticket->estado == 'resuelto') bg-success
                @elseif($ticket->estado == 'cerrado') bg-secondary
                @endif">
                {{ ucfirst(str_replace('_',' ',$ticket->estado)) }}
            </span>
        </p>
    </div>
</div>

<!-- Formulario -->
<div class="card p-4">
    <form method="POST" action="{{ route('admin.tickets.asignar', $ticket->id) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Seleccionar Técnico</label>
            <select name="id_tecnico" class="form-select @error('id_tecnico') is-invalid @enderror" required>
                <option value="">-- Selecciona --</option>
                @foreach($tecnicos as $tecnico)
                    <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                @endforeach
            </select>
            @error('id_tecnico')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Asignar</button>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection