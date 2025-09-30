<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class WebTicketController extends Controller
{
    // Listar tickets
    public function index()
    {
        $tickets = Ticket::with(['cliente','tecnico'])->get();
        return view('tickets.index', compact('tickets'));
    }

    // Formulario de creación de ticket
    public function create()
    {
        return view('tickets.create');
    }

    // Guardar ticket nuevo
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad' => 'required|in:baja,media,alta',
            'id_cliente' => 'required|integer|exists:usuarios,id',
        ]);

        $ticket = Ticket::create($data);

        if ($request->hasFile('adjunto')) {
            $path = $request->file('adjunto')->store('adjuntos','public');
            $ticket->adjuntos()->create(['archivo_url' => $path]);
        }

        return redirect()->route('tickets.index');
    }

    // Mostrar detalle de un ticket
    public function show($id)
    {
        $ticket = Ticket::with(['cliente','tecnico','comentarios.usuario','adjuntos'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }
}