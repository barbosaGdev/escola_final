<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class cidade extends Model
{

    public $timestamps = false;

    static function getCidades(){
        return DB::select("select * from cidades order by id desc"); //TAREFA 2 - ITEM f): Deixar Nilópolis como primeira opção
    }

    static function CadastrarCidade(){
        $cidade = new \App\Cidade();
        $cidade->nome = $_POST["nome"];
        $cidade->save();
    }

    static function deletarCidade(){
        return DB::select("delete from cidades where id=?", [$_POST["id"]]);
    }

}
