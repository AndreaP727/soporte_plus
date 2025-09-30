<?php

namespace App\Exports;

use App\Models\Ticket;

class TicketsExport
{
    public function collection()
    {
        return Ticket::with(['cliente','tecnico'])->get();
    }
}