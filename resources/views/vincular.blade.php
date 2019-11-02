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
                    <th type="hidden">Id</th>
                    <th>Candidato</th>
                    <th>Cidade</th>
                    <th>Bairro</th>
                    <th>Ano/Série/Fase</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Opção 1 de Escola</th>
                    <th>Opção 2 de Escola</th>
                    <th>Opção 3 de Escola</th>
                    <th>Ação</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatos as $candidato)
                    <tr>
                        <td type="hidden">{{$candidato->id}}</td>
                        <td>{{$candidato->nome}}</td>
                        <td>{{$candidato->cidade}}</td>
                        <td>{{$candidato->bairro}}</td>
                        <td>{{$candidato->serie}}</td>
                        <td>{{$candidato->cel}}</td>
                        <td>{{$candidato->email}}</td>
                        <td>{{$candidato->escola_1}}</td>
                        <td>{{$candidato->escola_2}}</td>
                        <td>{{$candidato->escola_3}}</td>
                        <td><a href="/generate/xls?id={{$candidato->id}}"><button class="btn-confirm">GERAR RELATÓRIO</button></a></td>
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