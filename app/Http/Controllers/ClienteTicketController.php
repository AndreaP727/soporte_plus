<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Adjunto;
use App\Models\Comentario;

class ClienteTicketController extends Controller
{
    // Listar tickets del cliente logueado
    public function index()
    {
        $tickets = Ticket::where('id_cliente', session('usuario_id'))
                         ->with('adjuntos')
                         ->get();

        return view('cliente.tickets.index', compact('tickets'));
    }

    // Formulario de creación
    public function create()
    {
        return view('cliente.tickets.create');
    }

    // Guardar ticket
    public function store(Request $request)
    {
        $data = $request->validate([
            'asunto' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'prioridad' => 'required|in:baja,media,alta',
            'descripcion' => 'nullable|string',
            'adjunto' => 'nullable|file|max:2048'
        ]);

        $data['id_cliente'] = session('usuario_id');

        $ticket = Ticket::create($data);

        if ($request->hasFile('adjunto')) {
            $path = $request->file('adjunto')->store('adjuntos','public');
            $ticket->adjuntos()->create(['archivo_url' => $path]);
        }

        return redirect()->route('cliente.tickets.index')->with('success', 'Ticket creado correctamente');
    }

    // Ver ticket con detalles, adjuntos y comentarios
    public function show($id)
    {
        $ticket = Ticket::with(['adjuntos','comentarios.usuario'])
                        ->where('id_cliente', session('usuario_id'))
                        ->findOrFail($id);

        return view('cliente.tickets.show', compact('ticket'));
    }

    // Agregar comentario al ticket
    public function comentar(Request $request, $id)
    {
        $ticket = Ticket::where('id_cliente', session('usuario_id'))->findOrFail($id);

        $request->validate([
            'mensaje' => 'required|string'
        ]);

        $ticket->comentarios()->create([
            'usuario_id' => session('usuario_id'),
            'mensaje' => $request->mensaje
        ]);

        return back()->with('success', 'Comentario agregado correctamente.');
    }
}