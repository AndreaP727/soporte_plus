<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Encuesta extends Model
{
use HasFactory;
protected $fillable = ['id_ticket','puntuacion','observaciones'];


public function ticket() { return $this->belongsTo(Ticket::class,'id_ticket'); }
}