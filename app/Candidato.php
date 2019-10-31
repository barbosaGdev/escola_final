<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidato extends Model
{
    public $timestamps = false; 

    static function verifyCad($cpf){
        $candidato = DB::select("select * from candidatos where cpf=?", [str_replace([" ", "-", "/", "."], ["", "", "", ""], $cpf)]);
        if(count($candidato) > 0)
            return true;
        return false;
    }

    static function getCandidatosBySchool($school){
        return DB::select("select * from candidatos where escola_1=? OR escola_2=? OR escola_3=? order by nome asc", [$school, $school, $school]);
    }

    static function getCandidatosBySchoolFinal($school){
        $escola = DB::select("select * from escolas where id=?", [$school]);
        if($escola[0]->started == "s")
            return DB::select("select * from candidatos where escola_matriculado=?", [$school]);
        else        
            return DB::select("select * from candidatos where escola_1=? OR escola_2=? OR escola_3=? order by nome asc", [$school, $school, $school]);
    }

    static function getCandidatosBySchoolMatriculed($school){
        return DB::select("select * from candidatos where escola_matriculado=? order by nome asc", [$school]);
    }

    static function getCandidato($id){
        return DB::select("select * from candidatos where id=?", [$id]);
    }

    static function editCandidato($arr){
        DB::update("update candidatos SET nome=?, cpf=?, rg=?, nome_pai=?, nome_mae=?, nome_responsavel=?, cpf_responsavel=?, rua=?, bairro=?, cidade=?, tel=?, cel=?, escola_1=?, escola_2=?, escola_3=?, escolaridade=?, serie=? status='Pendente' WHERE id=?", $arr);
    }

    static function deleteCandidato($id){
        DB::delete("delete from candidatos WHERE id=?", [$id]);
    }

    static function confirmCandidato($id){
        $candidato = DB::select("select * from candidatos where id=?", [$id])[0];
        if($candidato->status == "sucesso")
            return "Esse candidato já tem uma vaga ativa";

        $escola = DB::select("select escolaridades.*, escolas.* from escolas INNER JOIN escolaridades ON escolaridades.id=escolas.id where escolaridades.id=? AND escolaridades.serie LIKE'%" . $candidato->serie . "%'", [$_GET["escola"]]);
        if(count($escola) == 0)
            return "Essa escola não esta mais cadastrada no sistema";
            
        $escola = $escola[0];
        if($escola->vagas == 0)
            return "Essa escola/série não possui mais vagas";
        DB::update("update candidatos SET status='sucesso' WHERE id=?", [$id]);
        DB::update("update escolaridades set vagas=? where id=?", [intval($escola->vagas) - 1, $_GET["escola"]]);
        return true;

    }

    static function confirmCandidatoSupervisionar($id){
        $candidato = DB::select("select * from candidatos where id=?", [$id])[0];
        if($candidato->status == "sucesso")
            return "Esse candidato já tem uma vaga ativa";

        $escola = DB::select("select escolaridades.*, escolas.* from escolas INNER JOIN escolaridades ON escolaridades.id=escolas.id where escolaridades.id=? AND escolaridades.serie LIKE'%" . $candidato->serie . "%'", [$_GET["escola"]]);
        if(count($escola) == 0)
            return "Essa escola não esta mais cadastrada no sistema";
            
        $escola = $escola[0];
        if($escola->vagas == 0)
            return "Essa escola/série não possui mais vagas";
            DB::update("update candidatos SET status='Pendente' WHERE id=?", [$id]);
        return true;

    }

    static function getSpeciais(){
        return DB::select("select * from candidatos where escola_1 IS NULL AND status='Supervisionar'");
    }

}
