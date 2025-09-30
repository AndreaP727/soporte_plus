<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateEncuestasTable extends Migration
{
public function up()
{
Schema::create('encuestas', function (Blueprint $table) {
$table->id();
$table->foreignId('id_ticket')->constrained('tickets')->onDelete('cascade');
$table->tinyInteger('puntuacion')->nullable();
$table->text('observaciones')->nullable();
$table->timestamps();
});
}


public function down()
{
Schema::dropIfExists('encuestas');
}
}