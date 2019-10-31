<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Ranga&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <title>Matricula facil</title>
</head>

<body>

    @include("header")

    <p class="h1-special-1">Alunos da escola: {{$escola->nome}}</p>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data da pré matricula</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatos as $candidato)
                    <tr>
                        <td>{{$candidato->nome}}</td>
                        <td>{{$candidato->cpf}}</td>
                        <td>{{date("d/m/Y", $candidato->data)}}</td>
                        <td>@if($candidato->status == "sucesso")matriculado @else Pendente @endif</td>
                        <td>@if($candidato->status == "sucesso")matriculado @else <a @if($escola->started != 'n')href="/confir/vinculacao?id={{$candidato->id}}&escola={{$escola->id}}" @endif><button class="btn-confirm @if($escola->started == 'n') disabled" onclick="alert('Aguarde os administradores confirmar a inicialização das vagas')" @endif ">CONFIRMAR</button></a> @endif</td>
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