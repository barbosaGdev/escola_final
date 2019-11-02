    function abrirCronograma() {

        // Get the modal
        var modal = document.getElementById("ModalCronograma");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }






    function changeContent1() {
        if (document.querySelector("#content1").offsetHeight == 52) {
            document.querySelector("#arrow-title").style.transform = "rotate(90deg)";
            document.querySelector("#content1").style.height = document.querySelector("#content1").scrollHeight + "px";
        } else {
            document.querySelector("#arrow-title").style.transform = "rotate(-90deg)";
            document.querySelector("#content1").style.height = "50px";
        }
    }

    $("#input-cpf").mask("000.000.000-00");
    $("#input-data").mask("00/00/0000");
    $("#input-cpf-responsavel").mask("000.000.000-00");
    $("#input-residencial").mask("(00) 0000-0000");
    $("#input-celular").mask("(00) 00000-0000");
    $("#input-nis").mask("0000000000000000000000");
    $("#input-cep").mask("00000-000"); // TAREFA 2 - ITEM d): Máscara para CEP

    $("#input-cep").focusout(function() {
        let cep = $('#input-cep').val();
        cep = cep.replace("-", "");

        var urlStr = "https://viacep.com.br/ws/" + cep + "/json/";


        $.ajax({
            url: urlStr,
            type: "get",
            dataType: "json",
            sucess: function(data) {
                console.log(data);

                // $('#input-rua').val();
                // $('#input-bairro').val();
                // $('#input-cidade').val();
                // $('#input-estado').val();

            },
            error: function(erro) {
                console.log(erro);
            }
        })
    });


    function changeNis(nis) {
        if (nis == "yes") {
            document.querySelector("#input-nis").removeAttribute("disabled");
            document.querySelector("#input-nis").value = "";
        } else {
            document.querySelector("#input-nis").setAttribute("disabled", "")
            document.querySelector("#input-nis").value = "";
        }
    }

    function changeDeficiencia(def) {
        if (def == "yes") {
            document.querySelector("#input-deficiencia").removeAttribute("disabled");
            document.querySelector("#input-deficiencia").setAttribute("required", "");
            document.querySelector("#anexoDef").removeAttribute("disabled");
            document.querySelector("#input-deficiencia").value = "";
            document.querySelector(".div-escola-to-hide").style.display = 'none'; // TAREFA 2 - ITEM b): Problema com NEE resolvido, está ocultando caso seja deficiente
            document.querySelector(".select-special-1").removeAttribute("disabled");
            document.querySelector(".select-special-1").removeAttribute("disabled");
            document.querySelector("#escolasim1").removeAttribute("disabled");
            document.querySelector("#escolasim1").removeAttribute("disabled");
            document.querySelector("#escolasim2").removeAttribute("disabled");
            document.querySelector("#escolasim2").removeAttribute("disabled");
            document.querySelector("#escolasim3").removeAttribute("disabled");
            document.querySelector("#escolasim3").removeAttribute("disabled");
            document.querySelector("#escolasim3").removeAttribute("disabled");
            document.querySelector("#opcaoescola1").removeAttribute("disabled");
            document.querySelector("#opcaoescola2").removeAttribute("disabled");
            document.querySelector("#opcaoescola3").removeAttribute("disabled");





        } else {
            $('#anexoDef').val("");
            document.querySelector("#input-deficiencia").removeAttribute("disabled");
            document.querySelector("#anexoDef").setAttribute("disabled", "")
            document.querySelector("#input-deficiencia").value = "";
            document.querySelector(".div-escola-to-hide").style.display = 'block'; // TAREFA 2 - ITEM c): Problema com NEE resolvido, caso não seja, exibe modalidades
        }
    }

    function modalidadeEscolida() {

        selectModalidade = document.querySelector("#select_escolaridade");

        let html = "";

        if (selectModalidade.value == 1) {
            html = "<option>I fase</option>";
            html += "<option>II fase</option>";
            html += "<option>III fase</option>";
            html += "<option>IV fase</option>";
            html += "<option>V fase</option>";
            html += "<option>VI fase</option>";
            html += "<option>VII fase</option>";
            html += "<option>VIII fase</option>";
            html += "<option>IX fase</option>";
        }
        if (selectModalidade.value == 2) {
            html = "<option>1º ANO</option>";
            html += "<option>2º ANO</option>";
            html += "<option>3º ANO</option>";
            html += "<option>4º ANO</option>";
            html += "<option>5º ANO</option>";
            html += "<option>6º ANO</option>";
            html += "<option>7º ANO</option>";
            html += "<option>8º ANO</option>";
            html += "<option>9º ANO</option>";
        }
        if (selectModalidade.value == 3) {
            html = "<option>Berçário</option>";
            html += "<option>Infantil 1 (de 1 ano até 1 ano e 11 meses e 29 dias)</option>";
            html += "<option>Infantil 2 (de 2 ano até 2 ano e 11 meses e 29 dias)</option>";
            html += "<option>Infantil 3 (de 3 ano até 3 ano e 11 meses e 29 dias)</option>";
            html += "<option>Infantil 4 (de 4 ano até 4 ano e 11 meses e 29 dias)</option>";
            html += "<option>Infantil 5 (de 5 ano até 5 ano e 11 meses e 29 dias)</option>";
        }

        document.querySelector("#input_serie").innerHTML = html;
        setScholls();
    }

    function setScholls() {
        if (document.querySelector("#input_serie").value.length > 0 && document.querySelector("#select_escolaridade").value.length > 0) {
            $.ajax({
                type: "POST",
                url: "/get/schools/filtred",
                data: {
                    modalidade: document.querySelector("#select_escolaridade").value,
                    serie: document.querySelector("#input_serie").value,
                    "_token": document.querySelector("#token").value,
                },
                success: function(data) {
                    let html = "";
                    if (data.length == 0) {
                        html += "";
                    } else {
                        data.forEach(function(item) {
                            html += `<option value='${item.id}'>${item.nome}</option>`;
                        });
                    }

                    document.querySelector("#opcaoescola1").innerHTML = html;
                    document.querySelector("#opcaoescola2").innerHTML = html;
                    document.querySelector("#opcaoescola3").innerHTML = html;
                }
            });
        }
    }

    function changeDateNascimento() {

        if (document.querySelector("#asjdkl") == null) {
            let dia = document.querySelector("#dia_nascimento").value;
            let mes = document.querySelector("#mes_nascimento").value;
            let ano = document.querySelector("#ano_nascimento").value;

            if ((dia.length == 2 || dia.length == 1) && mes.length == 2 && ano.length == 4) {
                $.ajax({
                    url: "/verifydate",
                    type: "GET",
                    data: {
                        'dia': dia,
                        'mes': mes,
                        'ano': ano
                    },
                    success: function(data) {
                        if (data == "yes") {
                            document.querySelector(".div-escola-to-hide").style.display = 'none';
                            document.querySelector("#content1").style.height = "auto";
                            document.querySelector("#select_escolaridade").removeAttribute("required");
                            document.querySelector("#select_escolaridade").value = "";
                            document.querySelector("#input_serie").removeAttribute("required");
                            document.querySelector("#input_serie").value = "";
                            document.querySelector("#opcaoescola1").removeAttribute("required");
                            document.querySelector("#opcaoescola1").value = "";
                            document.querySelector("#opcaoescola2").removeAttribute("required");
                            document.querySelector("#opcaoescola2").value = "";
                            document.querySelector("#opcaoescola3").removeAttribute("required");
                            document.querySelector("#opcaoescola3").value = "";
                        } else {

                            document.querySelector(".div-escola-to-hide").style.display = 'inline';
                            document.querySelector("#content1").style.height = document.querySelector("#content1").scrollHeight + "px";
                            document.querySelector("#select_escolaridade").setAttribute("required", "required");
                            document.querySelector("#select_escolaridade").value = "";
                            document.querySelector("#input_serie").setAttribute("required", "required");
                            document.querySelector("#input_serie").value = "";
                            document.querySelector("#opcaoescola1").setAttribute("required", "required");
                            document.querySelector("#opcaoescola1").value = "";
                            document.querySelector("#opcaoescola2").setAttribute("required", "required");
                            document.querySelector("#opcaoescola2").value = "";
                            document.querySelector("#opcaoescola3").setAttribute("required", "required");
                            document.querySelector("#opcaoescola3").value = "";
                        }
                    }


                });
            }
            // TAREFA 2 - ITEM a): Verifica se o aluno possui mais que dezoito anos, caso tenha, oculta as 3 modalidades e 
            // fica apenas o EJA
            if (ano <= 2001) {
                document.querySelector(".option-1").style.display = 'none';
                document.querySelector(".option-2").style.display = 'none';
                document.querySelector(".option-3").style.display = 'none';
            } else {
                document.querySelector(".option-1").style.display = 'block';
                document.querySelector(".option-2").style.display = 'block';
                document.querySelector(".option-3").style.display = 'block';
            }
        }
    }