<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatastrofes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catastrofes', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('tipo');
            $table->text('descripcion');
            $table->string('region');
            $table->string('comuna');
            $table->dateTime('fecha');
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
        Schema::dropIfExists('catastrofes');
    }
}
