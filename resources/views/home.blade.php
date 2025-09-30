@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')
<div class="container text-center">
    <h1 class="mb-5">Bienvenido a SoportePlus</h1>
    <p class="lead">Selecciona tu tipo de usuario para ingresar al sistema:</p>

    <div class="row mt-4">
        <!-- Cliente -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="card-title">Cliente</h3>
                    <p class="card-text">Si eres cliente, accede para crear y consultar tus tickets de soporte.</p>
                    <a href="{{ route('login') }}?rol=cliente" class="btn btn-primary">Ingresar como Cliente</a>
                </div>
            </div>
        </div>

        <!-- Técnico -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="card-title">Técnico</h3>
                    <p class="card-text">Si eres técnico, accede para gestionar los tickets asignados.</p>
                    <a href="{{ route('login') }}?rol=tecnico" class="btn btn-warning">Ingresar como Técnico</a>
                </div>
            </div>
        </div>

        <!-- Administrador -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="card-title">Administrador</h3>
                    <p class="card-text">Si eres administrador, accede para supervisar y administrar el sistema.</p>
                    <a href="{{ route('login') }}?rol=admin" class="btn btn-danger">Ingresar como Administrador</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection