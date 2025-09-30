<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Usuario;

// 👇 importa las librerías necesarias
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;

class AdminTicketController extends Controller
{
    // Ver todos los tickets
    public function index()
    {
        $tickets = Ticket::with(['cliente', 'tecnico'])->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    // Formulario para asignar un técnico
    public function asignarForm($id)
    {
        $ticket = Ticket::findOrFail($id);
        $tecnicos = Usuario::where('rol', 'tecnico')->get();

        return view('admin.tickets.asignar', compact('ticket', 'tecnicos'));
    }

    // Guardar asignación
    public function asignar(Request $request, $id)
    {
        $request->validate([
            'id_tecnico' => 'required|exists:usuarios,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->id_tecnico = $request->id_tecnico;
        $ticket->estado = 'en_proceso'; // al asignar, se pone en proceso
        $ticket->save();

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket asignado correctamente');
    }

    // Exportar tickets a CSV
    public function exportCsv()
    {
        $fileName = 'tickets_' . now()->format('Ymd_His') . '.csv';
        $tickets = Ticket::with(['cliente','tecnico'])->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Asunto', 'Cliente', 'Técnico', 'Estado', 'Prioridad', 'Creado', 'Resuelto'];

        $callback = function() use ($tickets, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tickets as $t) {
                fputcsv($file, [
                    $t->id,
                    $t->asunto,
                    optional($t->cliente)->nombre,
                    optional($t->tecnico)->nombre,
                    $t->estado,
                    $t->prioridad,
                    $t->created_at,
                    $t->fecha_resolucion
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Exportar PDF
    public function exportPdf()
    {
        $tickets = Ticket::with(['cliente','tecnico'])->get();
        $pdf = Pdf::loadView('admin.reportes.pdf', compact('tickets'));
        return $pdf->download('tickets.pdf');
    }

    // Exportar Excel
    public function exportExcel()
{
    return Excel::create('tickets', function($excel) {
        $excel->sheet('Sheet1', function($sheet) {
            $data = Ticket::with(['cliente','tecnico'])->get()->toArray();
            $sheet->fromArray($data);
        });
    })->download('xlsx');
}

    // Dashboard con métricas
    public function dashboard()
    {
        $totalTickets = Ticket::count();
        $abiertos = Ticket::whereIn('estado', ['nuevo','en_proceso','en_espera'])->count();
        $cerrados = Ticket::whereIn('estado', ['resuelto','cerrado'])->count();

        $tiempoResolucion = Ticket::whereNotNull('fecha_resolucion')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, fecha_resolucion)) as horas')
            ->value('horas');

        return view('admin.dashboard', compact('totalTickets','abiertos','cerrados','tiempoResolucion'));
    }
}