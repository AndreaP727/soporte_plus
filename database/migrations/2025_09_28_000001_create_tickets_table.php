<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_tecnico')->nullable();
            $table->string('asunto');
            $table->string('categoria');
            $table->enum('prioridad',['baja','media','alta'])->default('media');
            $table->text('descripcion')->nullable();
            $table->enum('estado',['nuevo','en_proceso','en_espera','resuelto','cerrado'])->default('nuevo');
            $table->timestamp('fecha_resolucion')->nullable();
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_tecnico')->references('id')->on('usuarios')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}