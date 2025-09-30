@extends('layouts.app')

@section('title', 'Mis Tickets')

@section('content')
<h1 class="mb-4">Mis Tickets</h1>

<a href="{{ route('cliente.tickets.create') }}" class="btn btn-primary mb-3">Crear Ticket</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Asunto</th>
            <th>Categoría</th>
            <th>Prioridad</th>
            <th>Estado</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>
    <a href="{{ route('cliente.tickets.show', $ticket->id) }}">
        {{ $ticket->id }}
    </a>
</td>
                <td>{{ $ticket->asunto }}</td>
                <td>{{ $ticket->categoria }}</td>
                <td>{{ ucfirst($ticket->prioridad) }}</td>
                <td>
                    <span class="badge 
                        @if($ticket->estado == 'nuevo') bg-primary 
                        @elseif($ticket->estado == 'en_proceso') bg-warning text-dark
                        @elseif($ticket->estado == 'en_espera') bg-info
                        @elseif($ticket->estado == 'resuelto') bg-success
                        @elseif($ticket->estado == 'cerrado') bg-secondary
                        @endif">
                        {{ ucfirst(str_replace('_',' ',$ticket->estado)) }}
                    </span>
                </td>
                <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection