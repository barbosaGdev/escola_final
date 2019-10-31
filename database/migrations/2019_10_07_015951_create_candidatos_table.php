<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->text('id');
            $table->text('nome');
            $table->text('cpf');
            $table->text('rg')->nullable();
            $table->text('data_nascimento');
            $table->text('nome_pai')->nullable();
            $table->text('nome_mae')->nullable();
            $table->text('nome_responsavel')->nullable();
            $table->text('CPF_responsavel')->nullable();
            $table->text('email');
            $table->text('rua');
            $table->text('bairro');
            $table->text('cidade');
            $table->text('estado');
            $table->text('cep')->nullable();
            $table->text('sexo');
            $table->text('tem_nis');
            $table->text('nis');
            $table->text('tel')->nullable();
            $table->text('cel');
            $table->text('possui_deficiencia');
            $table->text('deficiencia')->nullable();
            $table->text('laudo')->nullable();
            $table->text('comprovante_residencia')->nullable();
            $table->text('escola_anterior')->nullable();
            $table->text('escola_1')->nullable();
            $table->text('escola_2')->nullable();
            $table->text('escola_3')->nullable();
            $table->text('irmao_na_escola1')->nullable();
            $table->text('irmao_na_escola2')->nullable();
            $table->text('irmao_na_escola3')->nullable();
            $table->text('pontos_escola_1')->nullable();
            $table->text('pontos_escola_2')->nullable();
            $table->text('pontos_escola_3')->nullable();
            $table->text('status');
            $table->text("escola_matriculado")->nullable();
            $table->integer('data');
            $table->text('escolaridade')->nullable();
            $table->text('serie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidatos');
    }
}
