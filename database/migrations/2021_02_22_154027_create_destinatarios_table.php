<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinatarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saludo_id')->nullable()->constrained();
            $table->string('name', 45);
            $table->foreignId('dependencia_id')->constrained();
            $table->foreignId('entidad_id')->constrained('entidades');
            $table->foreignId('cargo_id')->constrained();
            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'saludo_id',
                'name',
                'dependencia_id',
                'entidad_id',
                'cargo_id'
            ], 'unique_destinatarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinatarios');
    }
}
