@extends('layouts.app')

@section('title', 'Gestión de Tickets')

@section('content')
<h1 class="mb-4">Gestión de Tickets</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Asunto</th>
            <th>Cliente</th>
            <th>Técnico</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->asunto }}</td>
                <td>{{ $ticket->cliente->nombre }}</td>
                <td>{{ $ticket->tecnico->nombre ?? 'Sin asignar' }}</td>
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
                    <a href="{{ route('admin.tickets.asignarForm', $ticket->id) }}" class="btn btn-sm btn-primary">
                        Asignar Técnico
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- paginación -->
<div class="d-flex justify-content-center">
   {{ $tickets->links('pagination::bootstrap-4') }}
</div>
@endsection