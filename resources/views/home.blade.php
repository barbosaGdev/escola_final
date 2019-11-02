<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Ranga&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <link rel="stylesheet" href="/css/home.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery.mask.min.js"></script>
    <title>Matricula facil</title>
</head>

<body onload="abrirCronograma();">

    @include("header")
    
    @include("options")

    @include("popUpCronograma")


    <div class="div-content-1" id="content1">
        <div class="flex-left">
            <p class="p-option">Abrir</p>
            <img src="/images/left-arrow.png" id="arrow-title" class="image-arrow-option" onclick="changeContent1()">
        </div>
        <div id="content2" class="div-content-2">
            <form id="form_registers" action="registrar/candidato" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-nis">Possui NIS ? (Bolsa Família) </label></b>
                    <br>
                    <label class="label-radio" style="margin-left: 10%" for="simnis">SIM</label>
                    <input value="1" type="radio" onchange="changeNis('yes')" name="nis_" id="simnis">
                    <label class="label-radio" for="naonis">NÃO</label>
                    <input value="2" checked type="radio" onchange="changeNis('no')" name="nis_" id="naonis">
                    <input name="nis" id="input-nis" type="text" class="input-special-1" placeholder="NIS" disabled>
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-name">Nome do Candidato Completo *</label></b>
                    <input name="nome" required id="input-name" type="text" class="input-special-1"
                        placeholder="Nome completo">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-cpf">CPF do Candidato *</label></b>
                    <input name="cpf" id="input-cpf" type="text" class="input-special-1"
                        placeholder="CPF do candidato">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-rg">RG do Candidato</label></b>
                    <input name="rg" id="input-rg" type="text" class="input-special-1" placeholder="RG do candidato">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-data">Data de Nascimento*</label></b>
                    <select name="dia_nascimento" id="dia_nascimento" required onchange="changeDateNascimento()"
                        class="select-special-1">
                        <option value="">DIA</option>
                        @for($i=1; $i < 32; ++$i) <option value="{{$i}}">{{$i}}</option>
                            @endfor
                    </select>
                    <select name="mes_nascimento" id="mes_nascimento" required onchange="changeDateNascimento()"
                        class="select-special-1">
                        <option value="">MÊS</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                    <select name="ano_nascimento" id="ano_nascimento" required onchange="changeDateNascimento()"
                        class="select-special-1">
                        <option value="">ANO</option>
                        @for($i=intval(date("Y")); $i > 1920; --$i)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-pai">Nome do Pai</label></b>
                    <input name="nome_pai" id="input-pai" type="text" class="input-special-1" placeholder="Nome do Pai">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-mae">Nome da Mãe</label></b>
                    <input name="nome_mae" id="input-mae" type="text" class="input-special-1" placeholder="Nome da Mãe">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-responsavel">Nome do Responsável (Se você for o própio
                            candidato e é maior de idade, repita seu Nome completo)*</label></b>
                    <input required name="nome_responsavel" id="input-responsavel" type="text" class="input-special-1"
                        placeholder="Nome do Responsável">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-cpf-responsavel">CPF do Responsável (Se você for o
                            própio candidato e é maior de idade, repita seu CPF)*</label></b>
                    <input required name="cpf_responsavel" id="input-cpf-responsavel" type="text"
                        class="input-special-1" placeholder="CPF do Responsável">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1">Endereço:</label></b>
                    <br>
                    <br>
                    <b><label class="label-special-1" for="input-rua">Rua*</label></b>
                    <input required name="rua" id="input-rua" type="text" class="input-special-1" placeholder="Rua">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">Bairro*</label></b>
                    <input required name="bairro" id="input-bairro" type="text" class="input-special-1"
                        placeholder="Bairro">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">CEP</label></b>
                    <input name="cep" id="input-cep" type="text" class="input-special-1" placeholder="CEP">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-cidade">Cidade em que Reside*</label></b>
                    <select required name="cidade" id="input-cidade" type="text" class="select-special-1"
                        placeholder="Cidade">                    
                        @foreach($cidades as $cidade)
                        <option value="{{$cidade->nome}}">{{$cidade->nome}}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-estado">Estado que Reside*</label></b>
                    <select name="estado" disabled id="input-estado" type="text" class="select-special-1"
                        placeholder="Estado">
                        <option value="123">Rio de Janeiro</option>
                    </select>
                </div>

                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">Sexo*</label></b>
                    <br>
                    <input type="radio" name="sexo" value="1" checked id="masc" style="margin-left:10%">
                    <label class="label-radio" for="masc">Masculino</label>
                    <input type="radio" name="sexo" value="2" id="femi">
                    <label class="label-radio" for="femi">Feminino</label>
                    <input type="radio" name="sexo" value="3" id="outro">
                    <label class="label-radio" for="outro">Outro</label>
                </div>

                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-residencial">Telefone Residêncial</label></b>
                    <input name="tel" id="input-residencial" type="text" class="input-special-1"
                        placeholder="Telefone residêncial">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-celular">Telefone Celular*</label></b>
                    <input required name="cel" id="input-celular" type="text" class="input-special-1"
                        placeholder="Telefone celular">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-email">E-mail *</label></b>
                    <input name="email" id="input-email" type="email" class="input-special-1" required
                        placeholder="E-mail">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">Deficiência (NEE) ?</label></b>
                    <br>
                    <label class="label-radio" style="margin-left: 10%" for="defsim">SIM</label>
                    <input value="1" type="radio" onchange="changeDeficiencia('yes')" name="deficiencia_radio"
                        id="defsim">
                    <label class="label-radio" for="defnao">NÃO</label>
                    <!-- TAREFA 2 - ITEM c): NEE iniciado com a opção 'Não' -->
                    <input value="2" checked type="radio" onchange="changeDeficiencia('no')" name="deficiencia_radio"
                        id="defnao">
                    <input name="deficiencia" id="input-deficiencia" type="text" class="input-special-1"
                        placeholder="Qual ?">
                    <br>
                    <label class="label-radio" for="anexoDef" style="margin-left: 10%;">Laudo da Deficiência</label>
                    <input name="laudo" type="file" id="anexoDef">
                </div>
                <div class="div-input-special-1">
                    <b><label class="label-special-1" for="input-bairro">Comprovante de Residência</label></b>
                    <br>
                    <label class="label-radio" for="defnao" style="margin-left: 10%;">Envie o Comprovante de
                        Residência</label>
                    <input name="residencia" type="file" id="anexoResidencia">
                </div>
                <div class="div-input-special-1">
                        <b><label class="label-special-1" for="input-escola-anterior">Digite a Escola Anterior</label></b>
                        <input name="escola_anterior" id="input-escola-anterior" type="text" class="input-special-1"
                            placeholder="Escola anterior">
                    </div>
                <div class="div-escola-to-hide">
                    <div>
                        <b><label class="label-special-1" for="input-bairro">Modalidade*</label></b>
                        <select class="select-special-1" onchange="modalidadeEscolida(event)" required
                            name="escolaridade" id="select_escolaridade">
                            <option class="option-1" value="">MODALIDADE</option>
                            <option value="1">EJA</option>
                            <option class="option-2" value="2">FUNDAMENTAL</option>
                            <option class="option-3" value="3">INFANTIL</option>
                        </select>
                    </div>
                    <div>
                        <b><label class="label-special-1" for="input-bairro">Ano/Série/Fase*</label></b>
                        <select class="select-special-1" onchange="setScholls()" name="serie" required id="input_serie">
                            <option value="">Selecione a modalidade primeiro</option>
                        </select>
                    </div>
                    <div class="div-input-special-1" style="margin-top: 15px">
                        <b><label class="label-special-1" for="input-bairro">1º Opção de Escola</label></b>
                        <br>
                        <select class="select-special-1" name="escola1" novalidate id="opcaoescola1">
                        @foreach($escolas as $escola)
                            <option value="{{$escola->nome}}">{{$escola->nome}}</option> 
                        @endforeach
                        </select>
                        <div style="margin-top: 15px"></div>
                        <b><label class="label-special-1" for="input-bairro">Irmão nessa escola ?*</label></b>
                        <br>
                        <label class="label-radio" style="margin-left: 10%" for="escolasim1">SIM</label>
                        <input value="1" type="radio" name="irmao_na_escola1" id="escolasim1">
                        <label class="label-radio" for="escolanao1">NÃO</label>
                        <input value="2" checked type="radio" name="irmao_na_escola1" id="escolanao1">
                    </div>
                    <div class="div-input-special-1">
                        <b><label class="label-special-1" for="input-bairro">2º Opção de Escola</label></b>
                        <br>
                        <select class="select-special-1" name="escola2" novalidate id="opcaoescola2">
                        <!-- TAREFE 2 - ITEM g): Exibe os campos vazios -->
                        <option value=""></option>
                        @foreach($escolas as $escola)
                            <option value="{{$escola->nome}}">{{$escola->nome}}</option> 
                        @endforeach
                        </select>

                        <div style="margin-top: 15px"></div>
                        <b><label class="label-special-1" for="input-bairro">Irmão nessa escola ?*</label></b>
                        <br>
                        <label class="label-radio" style="margin-left: 10%" for="escolasim2">SIM</label>
                        <input value="1" type="radio" name="irmao_na_escola2" id="escolasim2">
                        <label class="label-radio" for="escolanao2">NÃO</label>
                        <input value="2" checked type="radio" name="irmao_na_escola2" id="escolanao2">
                    </div>
                    <div class="div-input-special-1">
                        <b><label class="label-special-1" for="input-bairro">3º Opção de Escola</label></b>
                        <br>
                        <select class="select-special-1" name="escola3" novalidate id="opcaoescola3" >
                        <!-- TAREFE 2 - ITEM g): Exibe os campos vazios -->
                        <option value=""></option>
                            @foreach($escolas as $escola)
                                <option value="{{$escola->nome}}">{{$escola->nome}}</option> 
                            @endforeach

                        </select>
                        <div style="margin-top: 15px"></div>
                        <b><label class="label-special-1" for="input-bairro">Irmão nessa escola ?*</label></b>
                        <br>
                        <label class="label-radio" style="margin-left: 10%" for="escolasim3">SIM</label>
                        <input value="1" type="radio" name="irmao_na_escola3" id="escolasim3">
                        <label class="label-radio" for="escolanao3">NÃO</label>
                        <input value="2" checked type="radio" name="irmao_na_escola3" id="escolanao3">
                    </div>
                </div>

                <button class="button-special-1">INSCRIÇÃO</button>
            </form>
        </div>
    </div>

    <h1 class="p-desc">Matricula Fácil Nilópolis</h1>
    <p class="p-desc">Faça a sua pré- matricula ou de seu filho sem sair de casa, cadastre-se e fique atento e acompanhe
        a pré-matricula no site <a href="http://nilopolis.gov.br">http://www.nilopolis.gov.br</a>.</p>

    @include("box_success_error")

    @if(isset($_GET["error"]))
    <script>
        let lista = "";
        @foreach(json_decode($_GET["error"]) as $error)
        lista += "<?php echo $error. '<br>' ?>";
        @endforeach
        showError(lista);
        setTimeout(function () {
            window.location.href = "/?";
        }, 5000);

 
       
        

    </script>
    @endif

    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="/js/home.js"></script>

</body>

</html>
