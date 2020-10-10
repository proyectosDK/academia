<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_cursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nota_id');
            $table->unsignedBigInteger('cursos_inscripcion_id');
            $table->integer('nota');

            $table->timestamps();

            $table->foreign('nota_id')->references('id')->on('notas')->onDelete('cascade');
            $table->foreign('cursos_inscripcion_id')->references('id')->on('cursos_inscripcions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas_cursos');
    }
}
