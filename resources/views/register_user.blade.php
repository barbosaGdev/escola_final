<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Ranga&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/register_user.css">
    <title>Matricula facil</title>
</head>

<body>

    @include("header")
    @include("options-adm")

    <div class="flex-center" style="margin-top: 20px; margin-bottom: 20px">
        <div class="box box-cad">
            <form action="/add/user" method="POST">
                <h1 class="h1-special-1">Cadastrar usuário</h1>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <label for="">Nome</label>
                <input type="text" name="nome" required class="input-special-1" placeholder="Nome">
                <label for="">Login</label>
                <input type="text" name="login" required class="input-special-1" placeholder="login">
                <label for="">Senha</label>
                <input type="password" name="senha" required class="input-special-1" placeholder="Senha">
                <label for="">Confirmar senha</label>
                <input type="password" name="senha_c" required class="input-special-1" placeholder="Confirar senha">
                <label for="">Selecione a escola associada</label>
                <select required class="select-special-1" name="escola" id="">
                    <option value="0">TODAS</option>
                    @foreach($escolas as $escola)
                        <option value="{{$escola->id}}">{{$escola->nome}}</option>
                    @endforeach
                </select>
                <label  for="in2">Secretário</label>
                <input name="tipo" value="2" required type="radio" id="in2"><br>
                <label  for="in3">Supervisor</label>
                <input name="tipo" value="3" required type="radio" class="m-b-15" id="in3"><br>
                <button class="button-special-1">CADASTRAR</button>
                <p class="p-alert">ATENÇÃO - APENAS SELECIONAR TODOS (NA ESCOLA) SE O USUÁRIO FOR DO TIPO SUPERVISOR</p>
            </form>
        </div>
    </div>

    <style>
        label{
            margin-left: 10%;
        }
    </style>
    
    @include("box_success_error")

    @if(isset($_GET["error"]))
        <script>
            showError("{{$_GET['error']}}");
        </script>
    @endif

    <script src="/js/jquery.min.js"></script>
    <script src="/js/login.js"></script>

</body>

</html>