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
    <div class="flex-center">
        <div class="box" style="width: 350px; margin-bottom: 20px">
            <a href="/create/school"><h1 class="h1-special-1">Adicionar escola</h1></a>
        </div>
    </div>
    <div class="container flex-center">
        <table>
            <thead>
                <tr>
                    <th>Escola</th>
                    <th>Ação</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($escolas as $escola)
                    <tr class="box box-citys" style="margin-bottom: 20px">
                        <td>{{$escola->nome}}</td>
                        <td><a href="/ver/candidatos?id={{$escola->id}}"><button class="btn-confirm">VER CANDIDATOS</button></a></td>
                        <td><a href="/ver/escola?id={{$escola->id}}"><button class="btn-confirm">EDITAR/VER ESCOLA</button></a></td>
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