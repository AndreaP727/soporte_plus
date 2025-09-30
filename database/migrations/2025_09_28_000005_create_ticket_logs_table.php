<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateTicketLogsTable extends Migration
{
public function up()
{
Schema::create('ticket_logs', function (Blueprint $table) {
$table->id();
$table->foreignId('id_ticket')->nullable()->constrained('tickets')->onDelete('set null');
$table->foreignId('usuario_id')->nullable()->constrained('usuarios')->onDelete('set null');
$table->string('accion');
$table->text('descripcion')->nullable();
$table->timestamps();
});
}


public function down()
{
Schema::dropIfExists('ticket_logs');
}
}