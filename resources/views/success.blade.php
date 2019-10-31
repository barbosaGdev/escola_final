<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/padrao.css">
    <link rel="stylesheet" href="/css/success.css">
    <title>Sistema de matricula</title>
</head>
<body>
    @include("header")
    <?php
        $title = "";
        $msg = "";

        if(isset($_GET["title"]))
            $title = $_GET["title"];
        if(isset($_GET["msg"]))
            $msg = $_GET["msg"];
    ?>
    <div class="div-msg-box">
        <h1 class="giz title">{{$title}}</h1>
        <p class="p-mensagem giz">{{$msg}}</p>
    </div>
</body>
</html>