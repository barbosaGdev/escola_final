<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Ranga&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/create_school.css">
    <title>Matricula facil</title>
</head>

<body>

    @include("header")
    @if(isset($_SESSION["adm"]))
        @include("options-adm");
    @else
        @include("options-supervisor");
    @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}" id="_token">

        <div class="box box-school">
            <h1 class="h1-simple-1 p-t-20">Cadastrar Escola</h1>
            <input type="text" class="input-special-1" id="input_name" placeholder="Nome da escola">
            <input type="text" class="input-special-1" id="input_endereco" placeholder="Endereço da escola">
            <p class="p-special-1">Adicionar escolaridade</p>
            <div class="flex-column m-b-15" id="sad64">
            </div>
            <button class="button-special-1" onclick="addSchool()">ADICIONAR ESCOLARIDADE</button>
            <button type="text" class="button-special-1 m-b-15 m-t-20" onclick="registrarEscola()">CADASTRAR</button>
        </div>
    
    @include("box_success_error")

    <script src="/js/jquery.min.js"></script>
    <script src="/js/create_school.js"></script>

</body>

</html>