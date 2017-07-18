<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evento_beneficio_id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->boolean('realizada')->default(false);
            $table->timestamps();
            
            $table->foreign('evento_beneficio_id')
                    ->references('id')->on('eventos_a_beneficio')
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
        Schema::dropIfExists('actividades');
    }
}
