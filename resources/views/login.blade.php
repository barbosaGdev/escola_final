<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Ranga&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/login.css">
    <title>Matricula facil</title>
</head>

<body>

    @include("header")
    @include("options-1");

    <div class="box box-login">
        <form action="/doLogin" method="POST">
            <h1 class="h1-simple-1 p-t-20">Login</h1>
            <input class="insput-special-1 m-b-15" required name="login" type="text" placeholder="Login">
            <input value="" class="insput-special-1 m-b-15" required name="senha" type="password" placeholder="Senha" >
            <label  for="in1">Logar como ADM</label>
            <input name="type_login" value="1" required type="radio" id="in1"><br>
            <label  for="in2">Logar como secretário</label>
            <input name="type_login" value="2" required type="radio" id="in2"><br>
            <label  for="in3">Logar como supervisor</label>
            <input name="type_login" value="3" required type="radio" class="m-b-15" id="in3"><br>
            <input name="_token" value="{{csrf_token()}}" type="hidden"><br>
            <button class="button-special-1 m-b-15">LOGIN</button>
        </form>
    </div>
    
    @include("box_success_error")
    @if(isset($_GET["error"]))
        <script>
            showError("{{$_GET['error']}}");
        </script>
    @endif

    <script src="/js/jquery.min.js"></script>

</body>

</html>