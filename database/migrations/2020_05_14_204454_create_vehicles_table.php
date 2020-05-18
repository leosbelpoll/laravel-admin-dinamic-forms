<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('standard_id');
            $table->unsignedInteger('automovil_id');
            $table->double('recorrido_inicial', 8, 2);
            $table->string('recorrido_inicial_image');
            $table->double('recorrido_final', 8, 2);
            $table->string('recorrido_final_image');
            $table->double('galones_comprados', 8, 2);
            $table->string('galones_comprados_image');
            $table->unsignedInteger('bomba_abastecimiento_id');
            $table->unsignedInteger('sistema_amortiguacion_id');
            $table->text('explicacion_capacitacion');
            $table->unsignedInteger('estado_medicion_id');
            $table->double('presion_neumaticos', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
