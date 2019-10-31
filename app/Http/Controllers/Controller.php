<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnViewRegistration(){
        $html = file_get_contents(__DIR__ . "/../../../resources/views/registration.blade.php");
        return ["html" => $html];
    }

    public function success(){
        return view("success");
    }

    public function returnViewlogin(){
        return view("login");
    }

    public function returnViewSchools(){
        $escolas = \App\Escola::getEscolas();
        return view("schools", ["escolas" => $escolas]);
    }

    public function returnViewCreateSchool(){
        return view("create_school");
    }

    public function returnViewRegisterUser(){
        $escolas = \App\Escola::getEscolas();
        return view("register_user", ["escolas" => $escolas]);
    }

    public function verifyDate(){
        $dia = $_GET["dia"];
        $mes = $_GET["mes"];
        $ano = $_GET["ano"];

        if(strlen($dia) < 2)
            $dia = "0" . $dia;
        if(strlen($mes) < 2)
            $mes = "0" . $mes;

        if(((time() - strtotime("$ano-$mes-$dia")) > (31536000*15)) && ((time() - strtotime("$ano-$mes-$dia")) < (31536000*18)))
            return "yes";
        else
            return "no";
    }

    public function generateXls(){

        $html = "";

        $candidatos = DB::select("select * from candidatos where escola_1=? OR escola_2=? OR escola_3=?", [$_GET["id"], $_GET["id"], $_GET["id"]]);
$html .= <<<HTML
<meta charset='UTF-8'>
        <table>
            <thead>
                <tr>
                    <td>Nome do candidato</td>
                    <td>CPF</td>
                    <td>RG</td>
                    <td>Nome do pai</td>
                    <td>Nome da mãe</td>
                    <td>Nome do responsável</td>
                    <td>CPF do responsável</td>
                    <td>Data de nascimento</td>
                    <td>Celular</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
HTML;

        foreach($candidatos as $item){
            $html .= "<tr>";
            $html .= "<td>" . $item->nome . "</td>";
            $html .= "<td>" . $item->cpf . "</td>";
            $html .= "<td>" . $item->rg . "</td>";
            $html .= "<td>" . $item->nome_pai . "</td>";
            $html .= "<td>" . $item->nome_mae . "</td>";
            $html .= "<td>" . $item->nome_responsavel . "</td>";
            $html .= "<td>" . $item->CPF_responsavel . "</td>";
            $html .= "<td>" . date("d/m/Y", $item->data_nascimento) . "</td>";
            $html .= "<td>" . $item->cel . "</td>";
            $html .= "<td>" . $item->status . "</td>";
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";
        echo $html;
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=relatorio.xls");
    }

    public function verComprovante(){
        $candidatos = DB::select("select * from candidatos where id=?", [$_GET["id"]]);
        if(count($candidatos) == 0)
            return "Nenhum candidato com esse ID, confira a URL";
        else
            return redirect("/files/" . $candidatos[0]->comprovante_residencia);
    }

    public function verLaudo(){
        $candidatos = DB::select("select * from candidatos where id=?", [$_GET["id"]]);
        if(count($candidatos) == 0)
            return "Nenhum candidato com esse ID, confira a URL";
        else
            return redirect("/files/" . $candidatos[0]->laudo);
    }

}
