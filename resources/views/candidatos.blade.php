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

    <div class="container flex-center">
        <table>
            <thead>
                <tr>
                    <th>Candidato</th>
                    <th>CPF</th>
                    <th>AÇÃO</th>
                    <th>AÇÃO</th>
                    <th>Compr. residência</th>
                    <th>Laudo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatos as $candidato)
                    <tr class="box box-citys" style="margin-bottom: 20px">
                        <td>{{$candidato->nome}}</td>
                        <td>{{$candidato->cpf}}</td>
                        <td><a href="/ver/candidato?id={{$candidato->id}}"><button class="btn-confirm">EDITAR/VER CANDIDATO</button></a></td>
                        <td><a href="/delete/candidato?id={{$candidato->id}}"><button class="btn-cancel">EXCLUIR</button></a></td>
                        <td><a target="_Blank" href="/ver/comprovante?id={{$candidato->id}}"><button class="btn-confirm">VER COMPROVANTE</button></a></td>
                        <td>@if(strlen($candidato->laudo) > 0)<a href="/ver/laudo?id={{$candidato->id}}"><button class="btn-confirm">VER LAUDO</button></a>@endif</td>
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
