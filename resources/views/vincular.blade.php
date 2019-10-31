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

    <p class="h1-special-1">Selecione um candidato</p>
    <div class="container flex-center">
        <table>
            <thead>
                <tr>
                    <th>Candidato</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatos as $candidato)
                    <tr>
                        <td>{{$candidato->nome}}</td>
                        <td>{{$candidato->cpf}}</td>
                        <td>{{$candidato->email}}</td>
                        <td><a href="/ver/candidato?id={{$candidato->id}}"><button class="btn-confirm">VER/EDITAR</button></a></td>
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