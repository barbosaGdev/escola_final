<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Ranga&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/citys.css">
    <title>Matricula facil</title>
</head>

<body>

    @include("header")
    @include("options-adm");

    <div class="container flex-center">
        <div>
            <h1 class="h1-special-1">Cidades</h1>
            <div class="box" style="width: 350px">
                <h1 class="h1-special-1">Adicionar cidade</h1>
                <form action="/add/city" method="POST">
                    <input required type="text" class="input-special-1" placeholder="Nome da cidade" name="nome">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="button-special-1">SALVAR</button>
                </form>
            </div>
            @foreach($cidades as $cidade)
                <div class="box box-citys" style="margin-bottom: 20px">
                    <form action="/delete/city" method="POST">
                        <p class="p-citys p-t-10">{{$cidade->nome}}</p>
                        <input type="hidden" name="id" value="{{$cidade->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="button-special-1">APAGAR</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    
    @include("box_success_error")

    <script src="/js/jquery.min.js"></script>
    <script src="/js/login.js"></script>

</body>

</html>