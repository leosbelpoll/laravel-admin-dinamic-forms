<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomovilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automoviles', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->integer("marca_id")->unsigned();
            $table->integer("modelo_id")->unsigned();
            $table->integer("tipo_vehiculo_id")->unsigned();
            $table->integer("tipo_combustible_id")->unsigned();
            $table->integer("cilindraje")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('automoviles');
    }
}
