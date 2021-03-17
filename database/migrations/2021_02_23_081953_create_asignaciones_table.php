<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('documento_id');
            $table->integer('anio');
            $table->date('fecha_emision')->nullable();
            $table->string('asunto')->nullable();
            $table->foreignId('destinatario_id')->nullable()->constrained();
            $table->text('respuesta')->nullable();
            $table->string('file')->nullable();
            $table->string('referencia')->nullable();
            $table->string('file_referencia')->nullable();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->foreignId('estado_documento_id')->default(1)->constrained('estado_documentos');
            $table->foreignId('user_id')->constrained()->comment('Usuario que reservó el documento');
            $table->foreignId('director_actual')
                ->constrained('users')
                ->comment('Director actual');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignaciones');
    }
}
