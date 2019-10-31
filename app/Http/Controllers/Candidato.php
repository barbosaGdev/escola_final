<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Candidato extends Controller
{
    public function register(){

        if(\App\Candidato::verifyCad($_POST["cpf"]))
            return redirect("/success?title=Candidato já cadastrado&msg=Esse candidato já foi cadastrado com esse CPF, não é possivel ter mais de 1 cadastro");

        $errors = array();
        $dia;
        $mes;
        $ano;
        $ano = $_POST["ano_nascimento"];
        $mes = $_POST["mes_nascimento"];
        $dia = $_POST["dia_nascimento"];
        if(strlen($_POST["nome"]) < 5 || strlen($_POST["nome"]) > 100)
            array_push($errors, "Insira um nome válido, entre 5 e 100 caracteres");
        if(!$this->validaCPF($_POST["cpf"]))
            array_push($errors, "Insira um CPF válido");
        if(strlen($_POST["rg"]) > 15)
            array_push($errors, "O RG não pode ter mais que 15 caracteres");
        if(!is_numeric($_POST["ano_nascimento"]) || strlen($_POST["ano_nascimento"]) < 1)
            array_push($errors, "Informe o ano na data de nascimento");
        if(strlen($_POST["nome_pai"]) < 1 && strlen($_POST["nome_mae"]) < 1)
            array_push($errors, "Informe o nome da mãe ou do pai do candidato");
        if(strlen($_POST["nome_responsavel"]) < 5 || strlen($_POST["nome_responsavel"]) > 100)
            array_push($errors, "Insira um nome de responsável válido, de 5 até 100 caracteres");
        if(!$this->validaCPF($_POST["cpf_responsavel"]))
            array_push($errors, "Insira um CPF de responsável válido");
        else{
            if($_POST["cpf_responsavel"] == $_POST["cpf"]){
                if(!is_numeric($_POST["dia_nascimento"]) || strlen($_POST["dia_nascimento"]) < 1)
                    return $errors;
                if(!is_numeric($_POST["mes_nascimento"]) || strlen($_POST["mes_nascimento"]) < 1)
                    return $errors;
                if(!is_numeric($_POST["ano_nascimento"]) || strlen($_POST["ano_nascimento"]) < 1)
                    return $errors;
                $ano = $_POST["ano_nascimento"];
                $mes = $_POST["mes_nascimento"];
                $dia = $_POST["dia_nascimento"];
                if(!((time() - strtotime("$ano-$mes-$dia")) > (31536000*18)))
                    array_push($errors, "Seu próprio CPF como responsável só é válido para maiores de idade");            
            }
        }
        if(strlen($_POST["rua"]) < 2)
            array_push($errors, "Insira uma rua válida");
        if(strlen($_POST["bairro"]) < 2)
            array_push($errors, "Insira um bairro válido");
        if(strlen($_POST["cidade"]) < 2)
            array_push($errors, "Insira uma cidade");
        if(intval($_POST["nis_"]) == 1 && strlen($_POST["nis"]) < 5)
            array_push($errors, "Insira um NIS válido");
        if(strlen(str_replace(["(", ")", "-", " "], ["", "", "", ""], $_POST["cel"])) != 11)
            array_push($errors, "Insira um número de celular válido");
        if(intval($_POST["deficiencia_radio"]) == 1 && strlen($_POST["deficiencia"]) < 3)
            array_push($errors, "Informe a deficiencia");
        if(count($errors) > 0){
            return redirect("/?error=" . json_encode($errors). "&reload=true");
        }else{
            $nis = "";
            $deficiencia = "";
            if(isset($_POST["nis"]))
                $nis = $_POST["nis"];
            if(isset($_POST["deficiencia"]))
                $deficiencia = $_POST["deficiencia"];
            $user = new \App\Candidato();
            $user->id = uniqid(true);
            $user->nome = $_POST["nome"];
            $user->cpf = str_replace([" ", "-", ".", "/"], ["", "", "", ""], $_POST["cpf"]);
            $user->rg = $_POST["rg"];
            $user->data_nascimento = strtotime("$ano-$mes-$dia");
            $user->nome_pai = $_POST["nome_pai"];
            $user->nome_mae = $_POST["nome_mae"];
            $user->nome_responsavel = $_POST["nome_responsavel"];
            $user->CPF_responsavel = $_POST["cpf_responsavel"];
            $user->rua = $_POST["rua"];
            $user->cep = $_POST["cep"];
            $user->escola_anterior = $_POST["escola_anterior"];
            $user->bairro = $_POST["bairro"];
            $user->email = $_POST["email"];
            $user->estado = "Rio de Janeiro";
            $user->cidade = $_POST["cidade"];
            $user->sexo = $_POST["sexo"];
            $user->tem_nis = $_POST["nis_"];
            $user->nis = $nis;
            $user->tel = $_POST["tel"];
            $user->cel = $_POST["cel"];
            $user->possui_deficiencia = $_POST["deficiencia_radio"];
            $user->deficiencia = $deficiencia;
            if(isset($_FILES["residencia"]["tmp_name"]) && strlen($_FILES["residencia"]["tmp_name"]) > 0){
                $nameArq = uniqid(true) . $_FILES["residencia"]["name"];
                $user->comprovante_residencia = $nameArq;
                rename($_FILES["residencia"]["tmp_name"], __DIR__ . "/../../../public_html/files/" . $nameArq);
            }
            if(isset($_FILES["laudo"]["tmp_name"])){
                $nameArq = uniqid(true) . $_FILES["laudo"]["name"];
                $user->laudo = $nameArq;
                move_uploaded_file($_FILES["laudo"]["tmp_name"], __DIR__ . "/../../../public_html/files/" . $nameArq);
            }
            if(isset($_POST["escola1"])){
                $user->escola_1 = $_POST["escola1"];
                $user->escola_2 = $_POST["escola2"];
                $user->escola_3 = $_POST["escola3"];
                $user->escolaridade = $_POST["escolaridade"];
                $user->serie = $_POST["serie"];
                $user->irmao_na_escola1 = $_POST["irmao_na_escola1"];
                $user->irmao_na_escola2 = $_POST["irmao_na_escola2"];
                $user->irmao_na_escola3 = $_POST["irmao_na_escola3"];
            }
                $user->data = time();
            $user->status = "Pendente";
            
            $pontos = 0;
            if($_POST["nis_"] == "1")
                $pontos += 1;
            if(strtoupper($_POST["cidade"]) == "NILOPOLIS" || strtoupper($_POST["cidade"]) == "NILÓPOLIS")
                $pontos += 6;
            if($_POST["deficiencia_radio"] == "1")
                $pontos += 2;

            $user->pontos_escola_1 = $pontos;
            $user->pontos_escola_2 = $pontos;
            $user->pontos_escola_3 = $pontos;

            if($user->irmao_na_escola1 == "1")
                $user->pontos_escola_1 += 1;
            if($user->irmao_na_escola2 == "1")
                $user->pontos_escola_2 += 1;
            if($user->irmao_na_escola3 == "1")
                $user->pontos_escola_3 += 1;

            if(((time() - strtotime("$ano-$mes-$dia")) > (31536000*15)) && ((time() - strtotime("$ano-$mes-$dia")) < (31536000*18)))
                $user->status = "Supervisionar";                
            else
                $user->status = "Pendente";                


            
            $user->save();

            $diaDaData = date("d/m/Y", time() + (86400*7));

            if(((time() - strtotime("$ano-$mes-$dia")) > (31536000*15)) && ((time() - strtotime("$ano-$mes-$dia")) < (31536000*18)))
                return redirect("/success?title=Pré matricula realizada&msg=ATENÇÃO, sua pré matricula foi cadastrada, para arantir sua vaga, compareça a SEMED SINOPOLIS dia $diaDaData. (se for feriado ou final de semana, compareça no próximo dia util)");
            else
                return redirect("/success?title=Cadastro realizado&msg=Sua pré matricula foi cadastrada, você pode acompanhar sua pré matricula na página inicial");
        }
    }

    
    public function validaCPF($cpf = null) {

        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }
    
        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        
        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {   
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }
}
