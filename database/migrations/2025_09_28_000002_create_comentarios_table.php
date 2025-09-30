<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade'); // 👈 usar ticket_id
    $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
    $table->text('mensaje');
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}