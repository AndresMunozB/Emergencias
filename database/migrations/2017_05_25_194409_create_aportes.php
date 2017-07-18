<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAportes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aportes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recoleccion_id');
            $table->string('nombre');
            $table->integer('necesario');
            $table->integer('recibido')->default(0);
            $table->timestamps();
            
            $table->foreign('recoleccion_id')
                    ->references('id')->on('recolecciones')
                    ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aportes');
    }
}