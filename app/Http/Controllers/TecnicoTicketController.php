<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TecnicoTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('id_tecnico', session('usuario_id'))
                         ->with('cliente')
                         ->get();

        return view('tecnico.tickets.index', compact('tickets'));
    }

    public function edit($id)
    {
        $ticket = Ticket::where('id_tecnico', session('usuario_id'))
                        ->with(['cliente','adjuntos','comentarios.usuario'])
                        ->findOrFail($id);

        return view('tecnico.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:en_proceso,en_espera,resuelto,cerrado',
        ]);

        $ticket = Ticket::where('id_tecnico', session('usuario_id'))->findOrFail($id);
        $ticket->estado = $request->estado;
        $ticket->save();

        return redirect()->route('tecnico.tickets.index')->with('success', 'Estado actualizado correctamente');
    }

    public function comentar(Request $request, $id)
    {
        $request->validate([
            'mensaje' => 'required|string|max:1000'
        ]);

        $ticket = Ticket::where('id_tecnico', session('usuario_id'))->findOrFail($id);

        $ticket->comentarios()->create([
            'usuario_id' => session('usuario_id'),
            'mensaje' => $request->mensaje
        ]);

        return back()->with('success', 'Comentario agregado');
    }
}