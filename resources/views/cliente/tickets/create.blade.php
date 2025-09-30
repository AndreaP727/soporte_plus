@extends('layouts.app')

@section('title', 'Crear Ticket')

@section('content')
<h1 class="mb-4">Crear Ticket</h1>

<form action="{{ route('cliente.tickets.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Asunto</label>
        <input type="text" name="asunto" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Categoría</label>
        <input type="text" name="categoria" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prioridad</label>
        <select name="prioridad" class="form-select">
            <option value="baja">Baja</option>
            <option value="media">Media</option>
            <option value="alta">Alta</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Adjunto</label>
        <input type="file" name="adjunto" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Crear</button>
    <a href="{{ route('cliente.tickets.index') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection