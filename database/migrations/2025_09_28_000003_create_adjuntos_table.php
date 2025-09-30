<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntosTable extends Migration
{
    public function up()
    {
        Schema::create('adjuntos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id') // 👈 Laravel buscará ticket_id por defecto
                  ->constrained('tickets')
                  ->onDelete('cascade');
            $table->string('archivo_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adjuntos');
    }
}