<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'usuario_id', 'mensaje'];

    public function ticket()
{
    return $this->belongsTo(Ticket::class, 'ticket_id');
}

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}