<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscolaridadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escolaridades', function (Blueprint $table) {
            $table->text('id');
            $table->text('escolaridade_id');
            $table->text('escolaridadeSelected');
            $table->text('serie');
            $table->integer('vagas');
            $table->integer('matutino');
            $table->integer('vespertino');
            $table->integer('noturno');
            $table->integer('integral');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escolaridades');
    }
}
