<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class User extends Model
{
    public $timestamps = false;

    static function registerUsuario(){
        $users = DB::select("select * from users where login=?", [$_POST["login"]]);
        if(count($users) > 0)
            return false;        
        $user = new \App\User();
        $user->nome = $_POST["nome"];
        $user->escola = $_POST["escola"];
        $user->login = $_POST["login"];
        $user->senha = $_POST["senha"];
        $user->tipo = $_POST["tipo"];
        $user->save();   
        return true;     
    }

    static function login($tipo, $login, $senha){
        $users = DB::select("select * from users where tipo=? and login=? and senha=?", [$tipo, $login, $senha]);
        if(count($users) > 0){
            $_SESSION["logged"] = true;
            $_SESSION["user"] = $users[0];
            return true;
        }else{
            return false;
        }
    }

    static function verificarStatus($cpf){
        $user = DB::select("select candidatos.nome, candidatos.status, escolas.nome as nome_escola from candidatos inner join escolas on escola_matriculado=escolas.id where cpf=?", [str_replace([" ", "-", ".", "/"], ["", "", "", ""], $cpf)]);
        if(count($user) > 0)
            return $user;
        else
            return "noCad";
    }

}
