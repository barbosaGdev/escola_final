<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Escola extends Model
{

    public $timestamps = false;

    static function getEscolas(){
        return DB::select("select * from escolas order by id desc");
    }

    static function registerEscola(){
       
          $escola = new \App\Escola();
        $escola->nome = $_POST["nome"]; 
        $escola->endereco = $_POST["endereco"]; 
        $id = uniqid(true); 
        $escola->id = $id; 
        $escola->started = 'n';
        foreach($_POST["infos"] as $item){
            $escolaridade = new \App\Escolaridade();
            $escolaridade->escolaridade_id = $item["id"];
            $escolaridade->escolaridadeSelected = $item["escolaridade"];
            $escolaridade->serie = $item["serie"];
            $escolaridade->id = $id;
            $escolaridade->vagas = intval($item["vagas"]);
            if($item["mat"] == "true")
                $escolaridade->matutino = 1;
            else
                $escolaridade->matutino = 2;
            if($item["ves"] == "true")
                $escolaridade->vespertino = 1;
            else
                $escolaridade->vespertino = 2;
            if($item["not"] == "true")
                $escolaridade->noturno = 1;
            else
                $escolaridade->noturno = 2;
            if($item["int"] == "true")
                $escolaridade->integral = 1;
            else
                $escolaridade->integral = 2;
            $escolaridade->save();
        }
        $escola->save();
    }

    static function editEscola(){
        $escola = getEscolaById($id);

        $escola = new \App\Escola();
        $escola->nome = $_POST["nome"]; 
        $escola->endereco = $_POST["endereco"]; 
        $id = uniqid(true); 
        $escola->id = $id; 
        $escola->started = 'n';
        foreach($_POST["infos"] as $item){
            $escolaridade = DB::select("select * from escolaridade where id=?" [$escolaridade_id]);
            $escolaridade = new \App\Escolaridade();
            $escolaridade->escolaridade_id = $item["id"];
            $escolaridade->escolaridadeSelected = $item["escolaridade"];
            $escolaridade->serie = $item["serie"];
            $escolaridade->id = $id;
            $escolaridade->vagas = intval($item["vagas"]);
            if($item["mat"] == "true")
                $escolaridade->matutino = 1;
            else
                $escolaridade->matutino = 2;
            if($item["ves"] == "true")
                $escolaridade->vespertino = 1;
            else
                $escolaridade->vespertino = 2;
            if($item["not"] == "true")
                $escolaridade->noturno = 1;
            else
                $escolaridade->noturno = 2;
            if($item["int"] == "true")
                $escolaridade->integral = 1;
            else
                $escolaridade->integral = 2;
            $escolaridade->save();
        }

        $escola->save();

        
    }

    static function deletarEscola(){
        DB::delete("delete from escolas where id=?", [$_POST["id"]]);
    }

    static function getEscolaById($id){
        return DB::select("select * from escolas where id=?", [$id]);
    }
    

}
