<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class User extends Controller
{
    public function registerUsuario(){
        if($_POST["senha"] == $_POST["senha_c"]){
            if(\App\User::registerUsuario())
                return redirect("/success?title=Cadastro realizado&msg=Usuario cadastrado com sucesso");
            else
                return redirect("/cad/user?error=Já existe um usuário com esse login");
        }else{
            return redirect("/cad/user?error=A senha não estava igual a senha de confirmação");
        }
    }

    public function login(){
        if($_POST["type_login"] == "1" && $_POST["login"] == "flaviasardinha32" && $_POST["senha"] == "semed_flavia@2020@#"){
            $_SESSION["adm"] = true;
            return redirect("/adm");
        }
        if(\App\User::login($_POST["type_login"], $_POST["login"], $_POST["senha"])){
            if($_POST["type_login"] == "2")
                return redirect("/secretario");
            if($_POST["type_login"] == "3")
                return redirect("/supervisor");
        }else{
            return redirect("/login?error=Credenciais enválidas");
        }
    }

    public function secretario(){
        $escola = \App\Escola::getEscolaById($_SESSION["user"]->escola);
        if(count($escola) > 0)
            $escola = $escola[0];
        else
            return redirect("/success?title=Ops&msg=A escola que você pertence foi apagada");
        $candidatos;
        if($escola->started != 'n')
            $candidatos = \App\Candidato::getCandidatosBySchoolMatriculed($escola->id);
        else
            $candidatos = \App\Candidato::getCandidatosBySchool($escola->id);

        return view("secretario", ["escola" => $escola, "candidatos" => $candidatos]);
    }

    public function follow(){
        return view("follow");
    }

    public function verificar(){
        return \App\User::verificarStatus($_POST["cpf"]);
    }

    public function supervisor(){
        return view("supervisor");
    }

    public function mostrarEscolas(){
        $escolas = \App\Escola::getEscolas();
        return view("schools_supervisor", ["escolas" => $escolas]);
    }

    public function candidatos(){
        $candidatos = \App\Candidato::getCandidatosBySchoolFinal($_GET["id"]);
        return view("candidatos", ["candidatos" => $candidatos]);
    }

    public function candidato(){
        $cidades = \App\Cidade::getCidades();  
        $escolas = \App\Escola::getEscolas();  
        $candidato = \App\Candidato::getCandidato($_GET["id"])[0];  
        return view('candidato', ["cidades" => $cidades, "escolas" => $escolas, "candidato" => $candidato]);        
    }

    public function editCandidato(){
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
                    return redirect("/ver/candidato?id=" . $_POST["idUser"] . "&error=" . json_encode($errors). "&reload=true");
                if(!is_numeric($_POST["mes_nascimento"]) || strlen($_POST["mes_nascimento"]) < 1)
                    return redirect("/ver/candidato?id=" . $_POST["idUser"] . "&error=" . json_encode($errors). "&reload=true");
                if(!is_numeric($_POST["ano_nascimento"]) || strlen($_POST["ano_nascimento"]) < 1)
                    return redirect("/ver/candidato?id=" . $_POST["idUser"] . "&error=" . json_encode($errors). "&reload=true");
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
            return redirect("/ver/candidato?id=" . $_POST["idUser"] . "&error=" . json_encode($errors). "&reload=true");
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
            $user->escola_anterior = $_POST["escola_anterior"];
            $user->cep = $_POST["cep"];
            $user->nome_responsavel = $_POST["nome_responsavel"];
            $user->CPF_responsavel = $_POST["cpf_responsavel"];
            $user->rua = $_POST["rua"];
            $user->bairro = $_POST["bairro"];
            $user->estado = "Rio de Janeiro";
            $user->cidade = $_POST["cidade"];
            $user->email = $_POST["email"];
            $user->sexo = $_POST["sexo"];
            $user->tem_nis = $_POST["nis_"];
            $user->nis = $nis;
            $user->tel = $_POST["tel"];
            $user->cel = $_POST["cel"];
            $user->possui_deficiencia = $_POST["deficiencia_radio"];
            $user->deficiencia = $deficiencia;
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
        }
        
        $salvar = json_decode(json_encode($user), true);        
        $salvar["id"] = $_POST["idUser"];
        $salvar["status"] = "Pendente";
        $user->where('id', $_POST["idUser"])->update($salvar);
        return redirect("/success?title=Candidato editado&msg=Candidato editado com sucesso! ");
    }

    public function deleteCandidato(){
        \App\Candidato::deleteCandidato($_GET["id"]);
        return redirect("/success?title=Apagado&msg=Candidato deletado com sucesso");
    }

    public function vincular(){
        $candidatos = \App\Candidato::getCandidatos();
        return view("vincular", ["candidatos" => $candidatos]);
    }

    public function vincularEscola(){
        $candidatos = \App\Candidato::getSpeciais();
        return view("vincular_escola", ["candidatos" => $candidatos]);
    }

    public function confirmarVinculacao(){
        $retorno = \App\Candidato::confirmCandidato($_GET["id"]);
        if($retorno === true)
            return redirect("/success?title=Vinculado&msg=prontinho, o candidato já possui essa vaga");
        else
            return redirect("/success?title=Ops&msg=" . $retorno);
    }

    public function start(){
        $escolas = \App\Escola::getEscolas();
        foreach($escolas as $escola){
            $escolaridades = DB::select("select * from escolaridades where id=? AND vagas > 0", [$escola->id]);
            foreach($escolaridades as $escolaridade){
                $vagas = $escolaridade->vagas;
                $candidatos = DB::select("select * from candidatos where (escola_1=? OR escola_2=? OR escola_3=?) AND serie LIKE '%" . $escolaridade->serie . "%' AND status='Pendente' ORDER BY pontos_escola_1 DESC, pontos_escola_2 DESC, pontos_escola_3 DESC, data asc", [$escola->id, $escola->id, $escola->id]);
                foreach($candidatos as $candidato){
                    if($vagas > 0){
                        DB::update("UPDATE candidatos SET status='reservado' WHERE id=?", [$candidato->id]);
                        DB::update("UPDATE candidatos SET escola_matriculado=? WHERE id=?", [$escola->id, $candidato->id]);
                        DB::update("UPDATE candidatos SET escola_1='', escola_2='', escola_3='' WHERE id=?", [$candidato->id]);
                    }
                }
            }
            DB::update("UPDATE escolas SET started='s' WHERE id=?", [$escola->id]);
        }
        return redirect("/success?title=SUCESSO&msg=As matriculas foram lançadas, só resta o secretário garantir a vaga para os candidatos");
    }    

    public function confirmarVinculacaoSupervisionar(){
        $retorno = \App\Candidato::confirmCandidatoSupervisionar($_GET["id"]);
        if($retorno === true)
            return redirect("/success?title=Vinculado&msg=A vaga foi ativa, o canditado deve comparecer a escola para confirmar a vaga");
        else
            return redirect("/success?title=Ops&msg=" . $retorno);
    }

    public function getSchools(){
        return DB::select("select escolas.id, escolas.nome from escolas INNER JOIN escolaridades ON escolas.id=escolaridades.id WHERE escolaridades.serie=?", [$_POST["serie"]]);
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

