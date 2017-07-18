<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catastrofe_id');
            $table->integer('user_id');
            $table->dateTime('fecha_limite');
            $table->integer('voluntarios');
            $table->boolean('aprobada')->default(false);
            $table->float('avance', 3, 2)->default(0.0);
            $table->nullableMorphs('medida');
            $table->timestamps();
            
            $table->foreign('catastrofe_id')
                    ->references('id')->on('catastrofes')
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
        Schema::dropIfExists('medidas');
    }
}
