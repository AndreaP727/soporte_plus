<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'id_tecnico',
        'asunto',
        'categoria',
        'prioridad',
        'descripcion',
        'estado',
    ];

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'id_cliente');
    }

    // Relación con técnico
    public function tecnico()
    {
        return $this->belongsTo(Usuario::class, 'id_tecnico');
    }

    // Relación con adjuntos
    public function adjuntos()
    {
        return $this->hasMany(Adjunto::class, 'ticket_id');
    }

    // Relación con comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'ticket_id');
    }
}