<!-- resources/views/tickets/index.blade.php -->
@extends('layouts.app')

@section('title', 'Lista de Tickets')

@section('content')
    <h1 class="mb-4">Lista de Tickets</h1>

    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Crear Ticket</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Cliente</th>
                <th>Técnico</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}">
                            {{ $ticket->titulo }}
                        </a>
                    </td>
                    <td>{{ $ticket->cliente->nombre }}</td>
                    <td>{{ $ticket->tecnico->nombre ?? 'Sin asignar' }}</td>
                    <td>
                        <span class="badge 
                            @if($ticket->estado == 'nuevo') bg-primary 
                            @elseif($ticket->estado == 'en_proceso') bg-warning text-dark
                            @elseif($ticket->estado == 'resuelto') bg-success
                            @elseif($ticket->estado == 'cerrado') bg-secondary
                            @else bg-info @endif">
                            {{ ucfirst($ticket->estado) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($ticket->prioridad == 'alta') bg-danger 
                            @elseif($ticket->prioridad == 'media') bg-warning text-dark
                            @else bg-success @endif">
                            {{ ucfirst($ticket->prioridad) }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay tickets aún</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection