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

    <div class="box box-login" style="margin-bottom: 20px;">
        <form id="form_verify">
            <p class=" h1-special-1 p-t-20" >Informe os as informações do candidato</p>
            <input class="insput-special-1 m-b-15" id="input-cpf" required name="cpf" type="text" placeholder="CPF do candidato">
            <input name="_token" value="{{csrf_token()}}" type="hidden"><br>
            <button class="button-special-1 m-b-15">VERIFICAR</button>
        </form>
    </div>
    
    @include("box_success_error")

    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>

    <script>
        $("#input-cpf").mask("000.000.000-00");
        jQuery('#form_verify').submit(function(){
			var dados = jQuery( this ).serialize();

			jQuery.ajax({
				type: "POST",
				url: "/verificar",
				data: dados,
				success: function(data){
                    console.log(data);
                    if(data[0].status == "Pendente")
                        showError("Sua matricula ainda esta pendente, aguarde mais um pouco");
                    if(data[0].status == "Supervisionar")
                        showError("Conclua sua matrícula indo a SEMED NILOPOLIS");
                    if(data[0].status == "reservado")
                        showError("Sua pré matrícula esta cadastrada, compareça a escola: " + data[0].nome_escola + ", para confirmar a matricula");
                    if(data[0].cpf == null || data[0].status == "rejeitado")
                        showError("O candidato não cadastrou o cpf ou teve sua matrícula rejeitada, favor aguarda na fila da escola em que se inscreveu!");
                    if(data[0].status == "sucesso")
                        showSuccess("Sua matricula foi reservada, por favor, comparecer à SEMED NILOPOLIS para confirmar a vaga o mais rapido possivel! (não se esqueça de levar um documento com foto)");
                },
                error: function(data){
                    console.log(data);
                    showError("Houve algum erro, por favor, entre em contato com o administrador do sistema");
                }
			});
			return false;
		});
    </script>

</body>

</html>