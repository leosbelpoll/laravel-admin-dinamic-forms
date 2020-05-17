<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standards', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->text("description")->nullable();
            $table->string("type");
            $table->unsignedInteger('standard_id')->nullable();
            $table->unsignedInteger('formulario_id')->nullable();
            $table->timestamps();
        });

        Schema::table('standards', function (Blueprint $table) {
            $table->foreign('standard_id')->references('id')->on('standards');
        });

        Schema::table('standards', function (Blueprint $table) {
            $table->foreign('formulario_id')->references('id')->on('formularios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standards');
    }
}
