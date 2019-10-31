<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Ranga&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <link rel="stylesheet" href="/css/home.css">
    <title>Matricula facil</title>
</head>

<body>

    @include("header")
    @include("options-supervisor")

    <div class="div-content-1" id="content1">
        <div class="flex-left">
            <p class="p-option">Abrir</p>
            <img src="/images/left-arrow.png" id="arrow-title" class="image-arrow-option" onclick="changeContent1()">
        </div>
        <div id="content2" class="div-content-2">
            <form id="form_registers" action="/edit/candidato" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-nis">Possui NIS ?</label></b>
                    <br>
                    <label class="label-radio" style="margin-left: 10%" for="simnis">SIM</label>
                    <input @if($candidato->tem_nis == 1) checked @endif value="1" type="radio" onchange="changeNis('yes')" name="nis_" id="simnis">
                    <label class="label-radio" for="naonis">NÃO</label>
                    <input @if($candidato->tem_nis == 2) checked @endif value="2" checked type="radio" onchange="changeNis('no')" name="nis_" id="naonis">
                    <input name="nis" id="input-nis" type="text" class="input-special-1" value="{{$candidato->nis}}" placeholder="NIS" disabled>
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-name">Nome do candidato completo *</label></b>
                    <input name="nome" required id="input-name" type="text" class="input-special-1" value="{{$candidato->nome}}" placeholder="Nome completo">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-cpf">CPF do candidato *</label></b>
                    <input name="cpf" required id="input-cpf" value={{$candidato->cpf}} type="text" class="input-special-1"
                        placeholder="CPF do candidato">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-rg">RG do candidato</label></b>
                    <input name="rg" id="input-rg" type="text" value={{$candidato->rg}} class="input-special-1" placeholder="RG do candidato">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-data">Data de nascimento*</label></b>
                    <select name="dia_nascimento" id="dia_nascimento" required onchange="changeDateNascimento()"
                        class="select-special-1">
                        <option value="">DIA</option>
                        @for($i=1; $i < 32; ++$i) <option @if(intval($i) == intval(date("d", $candidato->data_nascimento))) selected @endif value="{{$i}}">{{$i}}</option>
                            @endfor
                    </select>
                    <select name="mes_nascimento" id="mes_nascimento" required onchange="changeDateNascimento()"
                        class="select-special-1">
                        <option value="">MÊS</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(1)) selected @endif value="01">Janeiro</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(2)) selected @endif value="02">Fevereiro</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(3)) selected @endif value="03">Março</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(4)) selected @endif value="04">Abril</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(5)) selected @endif value="05">Maio</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(6)) selected @endif value="06">Junho</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(7)) selected @endif value="07">Julho</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(8)) selected @endif value="08">Agosto</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(9)) selected @endif value="09">Setembro</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(10)) selected @endif value="10">Outubro</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(11)) selected @endif value="11">Novembro</option>
                        <option @if(intval(date("m", $candidato->data_nascimento)) == intval(12)) selected @endif value="12">Dezembro</option>
                    </select>
                    <select name="ano_nascimento" id="ano_nascimento" required onchange="changeDateNascimento()"
                        class="select-special-1">
                        <option value="">ANO</option>
                        @for($i=intval(date("Y")); $i > 1920; --$i)
                        <option @if(intval(date("Y", $candidato->data_nascimento)) == $i) selected @endif value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-pai">Nome do pai</label></b>
                    <input name="nome_pai" id="input-pai" type="text" value="{{$candidato->nome_pai}}" class="input-special-1" placeholder="Nome do pai">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-mae">Nome da mãe</label></b>
                    <input name="nome_mae" id="input-mae" type="text" value="{{$candidato->nome_mae}}" class="input-special-1" placeholder="Nome da mãe">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-responsavel">Nome do responsável (Se você for o própio
                            candidato e é maior de idade, repita seu Nome completo)*</label></b>
                    <input required name="nome_responsavel" id="input-responsavel" value="{{$candidato->nome_responsavel}}" type="text" class="input-special-1"
                        placeholder="Nome do responsável">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-cpf-responsavel">CPF do responsável (Se você for o
                            própio candidato e é maior de idade, repita seu CPF)*</label></b>
                    <input required name="cpf_responsavel" id="input-cpf-responsavel" value="{{$candidato->CPF_responsavel}}" type="text"
                        class="input-special-1" placeholder="CPF do responsável">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1">Endereço:</label></b>
                    <br>
                    <br>
                    <b><label class="label-special-1" for="input-rua">Rua*</label></b>
                    <input required name="rua" id="input-rua" type="text" value="{{$candidato->rua}}" class="input-special-1" placeholder="Rua">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-cep">Cep</label></b>
                    <input name="cep" id="input-cep" type="text" value="{{$candidato->cep}}" class="input-special-1"
                        placeholder="cep">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">Bairro*</label></b>
                    <input required name="bairro" id="input-bairro" type="text" value="{{$candidato->bairro}}" class="input-special-1"
                        placeholder="Bairro">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-cidade">Cidade*</label></b>
                    <select required name="cidade" id="input-cidade" type="text" class="select-special-1"
                        placeholder="Cidade">
                        @foreach($cidades as $cidade)
                        <option @if($cidade->nome == $candidato->cidade) selected @endif value="{{$cidade->nome}}">{{$cidade->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-estado">Estado que reside*</label></b>
                    <select name="estado" disabled id="input-estado" type="text" class="select-special-1"
                        placeholder="Estado">
                        <option value="123">Rio de Janeiro</option>
                    </select>
                </div>

                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">Sexo*</label></b>
                    <br>
                    <label class="label-radio" style="margin-left: 10%" for="masc">Masculino</label>
                    <input @if($candidato->sexo == 1) checked @endif type="radio" name="sexo" value="1" checked id="masc">
                    <label class="label-radio" for="femi">Feminino</label>
                    <input @if($candidato->sexo == 2) checked @endif type="radio" name="sexo" value="2" id="femi">
                    <label class="label-radio" for="outro">Outro</label>
                    <input @if($candidato->sexo == 3) checked @endif type="radio" name="sexo" value="3" id="outro">
                </div>

                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-residencial">Telefone residêncial</label></b>
                    <input name="tel" id="input-residencial" value="{{$candidato->tel}}" type="text" class="input-special-1"
                        placeholder="Telefone residêncial">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-celular">Telefone celular*</label></b>
                    <input required name="cel" id="input-celular" value="{{$candidato->cel}}" type="text" class="input-special-1"
                        placeholder="Telefone celular">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-email">E-mail *</label></b>
                    <input name="email" id="input-email" value="{{$candidato->email}}" type="email" class="input-special-1" required
                        placeholder="E-mail">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">Deficiência (NEE) ?*</label></b>
                    <br>
                    <label class="label-radio" style="margin-left: 10%" for="defsim">SIM</label>
                    <input @if($candidato->possui_deficiencia == 1) checked @endif value="1" checked type="radio" onchange="changeDeficiencia('yes')" name="deficiencia_radio"
                        id="defsim">
                    <label class="label-radio" for="defnao">NÃO</label>
                    <input @if($candidato->possui_deficiencia == 2) checked @endif value="2" type="radio" onchange="changeDeficiencia('no')" name="deficiencia_radio"
                        id="defnao">
                    <input name="deficiencia" id="input-deficiencia" value="{{$candidato->deficiencia}}" type="text" class="input-special-1"
                        placeholder="Qual ?">
                    <br>
                    @if(strlen($candidato->laudo) > 0)
                        <a href="/files/{{$candidato->laudo}}" style="margin-left: 10%"><label style="color: blue; cursor: pointer;" class="label-radio" for="anexoDef" style="margin-left: 10%;">Laudo da deficiência</label></a>
                    @endif
                </div>
                <div class="div-input-special-1">
                    @if(strlen($candidato->comprovante_residencia) > 0)
                        <a href="/files/{{$candidato->comprovante_residencia}}" style="margin-left: 10%"><label style="color: blue; cursor: pointer;" class="label-radio" for="anexoDef" style="margin-left: 10%;">Comprovante de residência</label></a>
                    @endif
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-escola-anterior">Escola anterior</label></b>
                    <input name="escola_anterior" id="input-escola-anterior" type="text" value="{{$candidato->escola_anterior}}" class="input-special-1"
                        placeholder="Escola anterior">
                </div>
                <div class="div-escola-to-hide">
                    <div>
                        <b><label class="label-special-1" for="input-bairro">Modalidade*</label></b>
                        <select class="select-special-1" onchange="modalidadeEscolida()" required
                            name="escolaridade" id="select_escolaridade">
                            <option value="">MODALIDADE</option>
                            <option value="1">EJA</option>
                            <option value="2">FUNDAMENTAL</option>
                            <option value="3">INFANTIL</option>
                        </select>
                    </div>
                    <div>
                        <b><label class="label-special-1" for="input-bairro">Fase*</label></b>
                        <select class="select-special-1" onchange="setScholls()" name="serie" required id="input_serie">
                            <option value="">Selecione a modalidade primeiro</option>
                        </select>
                    </div>
                    <div class="div-input-special-1" style="margin-top: 15px">
                        <b><label class="label-special-1" for="input-bairro">1º Opção de escola</label></b>
                        <br>
                        <select class="select-special-1" name="escola1" required id="opcaoescola1">

                        </select>
                        <div style="margin-top: 15px"></div>
                        <b><label class="label-special-1" for="input-bairro">Irmão nessa escola ?*</label></b>
                        <br>
                        <label class="label-radio" style="margin-left: 10%" for="escolasim1">SIM</label>
                        <input @if($candidato->irmao_na_escola1 == 1) checked @endif value="1" type="radio" name="irmao_na_escola1" required id="escolasim1">
                        <label class="label-radio" for="escolanao1">NÃO</label>
                        <input @if($candidato->irmao_na_escola1 == 2) checked @endif value="2" type="radio" name="irmao_na_escola1" required id="escolanao1">
                    </div>
                    <div class="div-input-special-1">
                        <b><label class="label-special-1" for="input-bairro">2º Opção de escola</label></b>
                        <br>
                        <select class="select-special-1" name="escola2" required id="opcaoescola2">

                        </select>

                        <div style="margin-top: 15px"></div>
                        <b><label class="label-special-1" for="input-bairro">Irmão nessa escola ?*</label></b>
                        <br>
                        <label class="label-radio" style="margin-left: 10%" for="escolasim2">SIM</label>
                        <input @if($candidato->irmao_na_escola2 == 1) checked @endif value="1" type="radio" name="irmao_na_escola2" required id="escolasim2">
                        <label class="label-radio" for="escolanao2">NÃO</label>
                        <input @if($candidato->irmao_na_escola2 == 2) checked @endif value="2" type="radio" name="irmao_na_escola2" required id="escolanao2">
                    </div>
                    <div class="div-input-special-1">
                        <b><label class="label-special-1" for="input-bairro">3º Opção de escola</label></b>
                        <br>
                        <select class="select-special-1" name="escola3" required id="opcaoescola3">

                        </select>
                        <div style="margin-top: 15px"></div>
                        <b><label class="label-special-1" for="input-bairro">Irmão nessa escola ?*</label></b>
                        <br>
                        <label class="label-radio" style="margin-left: 10%" for="escolasim3">SIM</label>
                        <input @if($candidato->irmao_na_escola3 == 1) checked @endif value="1" type="radio" name="irmao_na_escola3" required id="escolasim3">
                        <label class="label-radio" for="escolanao3">NÃO</label>
                        <input @if($candidato->irmao_na_escola3 == 2) checked @endif value="2" checked type="radio" name="irmao_na_escola3" required id="escolanao3">
                    </div>
                </div>
                <input type="hidden" id="asjdkl" name="idUser" value="{{$_GET["id"]}}">
                <button class="button-special-1">EDITAR</button>
            </form>
        </div>
    </div>

    @include("box_success_error")

    @if(isset($_GET["error"]))
    <script>
        let lista = "";
        @foreach(json_decode($_GET["error"]) as $error)
        lista += "<?php echo $error. '<br>' ?>";
        @endforeach
        showError(lista);
        setTimeout(function () {
            window.location.href = "/ver/candidato?id={{$_GET['id']}}";
        }, 5000);

    </script>
    @endif

    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="/js/home.js"></script>
    <script>
        
        document.querySelector("#select_escolaridade").value="{{$candidato->escolaridade}}";
        modalidadeEscolida();
        document.querySelector("#input_serie").value="{{$candidato->serie}}";
        $.ajax({
            type: "POST",
            url: "/get/schools/filtred",
            data: {
                modalidade: document.querySelector("#select_escolaridade").value,
                serie: document.querySelector("#input_serie").value,
                "_token": document.querySelector("#token").value,
            },
            success: function(data){
                let html = "";
                if(data.length == 0){
                    html += "";
                }else{
                    data.forEach(function(item){
                        html += `<option value='${item.id}'>${item.nome}</option>`;
                    });
                }

                document.querySelector("#opcaoescola1").innerHTML = html;
                document.querySelector("#opcaoescola2").innerHTML = html;
                document.querySelector("#opcaoescola3").innerHTML = html;

                document.querySelector("#opcaoescola1").value = '{{$candidato->escola_1}}';
                document.querySelector("#opcaoescola2").value = '{{$candidato->escola_2}}';
                document.querySelector("#opcaoescola3").value = '{{$candidato->escola_2}}';

            }
        });
        
    </script>

</body>

</html>
