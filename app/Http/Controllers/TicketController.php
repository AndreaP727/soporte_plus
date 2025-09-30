<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Usuario;
use App\Models\TicketLog;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // 📌 Listar tickets (con filtros opcionales: estado, prioridad)
    public function index(Request $request)
    {
        $query = Ticket::with(['cliente', 'tecnico', 'adjuntos']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        return response()->json($query->paginate(15));
    }

    // 📌 Crear un ticket
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad'   => 'required|in:baja,media,alta',
            'categoria'   => 'nullable|string',
            'id_cliente'  => 'required|integer|exists:usuarios,id',
        ]);

        // Asignar técnico con menos tickets abiertos (simple)
        $tecnico = Usuario::where('rol', 'tecnico')
            ->withCount(['ticketsAsignado as abiertos_count' => function ($q) {
                $q->whereIn('estado', ['nuevo', 'en_proceso']);
            }])
            ->orderBy('abiertos_count', 'asc')
            ->first();

        if ($tecnico) {
            $data['id_tecnico'] = $tecnico->id;
        }

        $ticket = Ticket::create($data);

        TicketLog::create([
            'id_ticket'  => $ticket->id,
            'usuario_id' => $data['id_cliente'],
            'accion'     => 'creado',
            'descripcion'=> 'Ticket creado'
        ]);

        // Si se adjunta archivo
        if ($request->hasFile('adjunto')) {
            $path = $request->file('adjunto')->store('adjuntos', 'public');
            $ticket->adjuntos()->create(['archivo_url' => $path]);
        }

        return response()->json($ticket, 201);
    }

    // 📌 Mostrar detalle de un ticket
    public function show($id)
    {
        $ticket = Ticket::with(['comentarios.usuario', 'adjuntos'])->findOrFail($id);
        return response()->json($ticket);
    }

    // 📌 Actualizar un ticket (estado, técnico, etc.)
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $data = $request->only(['estado', 'id_tecnico', 'fecha_resolucion', 'prioridad']);
        $ticket->update($data);

        TicketLog::create([
            'id_ticket'  => $ticket->id,
            'usuario_id' => $request->user_id ?? null,
            'accion'     => 'actualizado',
            'descripcion'=> json_encode($data)
        ]);

        return response()->json($ticket);
    }
}