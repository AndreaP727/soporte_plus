@extends('layouts.app')

@section('title', 'Mis Tickets')

@section('content')
<h1 class="mb-4">Mis Tickets Asignados</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Asunto</th>
            <th>Cliente</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->asunto }}</td>
                <td>{{ $ticket->cliente->nombre }}</td>
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
                <td>
                    <a href="{{ route('tecnico.tickets.edit', $ticket->id) }}" class="btn btn-sm btn-primary">
                        Ver / Cambiar Estado
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection