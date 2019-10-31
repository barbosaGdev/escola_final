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
    @include("options-supervisor");

    <p class="h1-special-1">Candidatos (Para pesquisar, aperte Ctrl + F)</p>
    <div class="container flex-center">
        <table>
            <thead>
                <tr>
                    <th>Candidato</th>
                    <th>CPF</th>
                    <th>status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatos as $candidato)
                    <tr class="box box-citys" style="margin-bottom: 20px">
                        <td>{{$candidato->nome}}</td>
                        <td>{{$candidato->cpf}}</td>
                        <td>{{$candidato->status}}</td>
                        <td>@if($candidato->status == "sucesso")matriculado @else <a href="/ver/candidato?id={{$candidato->id}}&escola={{$_GET["id"]}}"><button class="btn-confirm">VINCULAR</button></a> @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @include("box_success_error")

    <script src="/js/jquery.min.js"></script>
    <script src="/js/login.js"></script>

</body>

</html>