let escolas = [];
let token = document.querySelector("#_token").value;


function addSchool(){
   
    let id = "asd" + Math.trunc((Math.random()+1) * 454654046);

    escolas.push(id);

    let html = "";
    html += '<div class="div-school" id="' + id + '">';
    html += '<input type="number" class="input-special-1" id="vagas' + id + '" placeholder="Quantas vagas?">';
    html += '<div class="flex-center m-b-15">';
    html += '<select type="text" onchange="modalidadeEscolida(event, \'' + id + '\')" id="escolaridade' + id + '" class="input-special-2 m-l-5 m-r-5">';
    html += '<option value=""></option>';
    html += '<option value="1">EJA Noite</option>';
    html += '<option value="2">EJA Vespertino/Tarde</option>';
    html += '<option value="3">FUNDAMENTAL</option>';
    html += '<option value="4">INFANTIL</option>';
    html += '</select>';
    html += '<select type="text" id="serie' + id + '" class="input-special-2 m-l-5 m-r-5">';
    html += '</select>';
    html += '</div>';
    html += '<div>';
    html += '<input type="checkbox" name="" class="margin-special-1" id="mat' + id + '">';
    html += '<label for="mat' + id + '">Matutino</label>';
    html += '</div>';
    html += '<div>';
    html += '<input type="checkbox" name="" class="margin-special-1" id="ves' + id + '">';
    html += '<label for="ves' + id + '">Vespertino</label>';
    html += '</div>';
    html += '<div>';
    html += '<input type="checkbox" name="" class="margin-special-1" id="not' + id + '">';
    html += '<label for="not' + id + '">Noturno</label>';
    html += '</div>';
    html += '<div>';
    html += '<input type="checkbox" name="" class="margin-special-1" id="int' + id + '">';
    html += '<label for="int' + id + '">Integral</label>';
    html += '</div>';
    html += '<button class="button-special-3" onclick="removerEscolaridade(\'' + id + '\')">REMOVER ESCOLARIDADE</button>';
    html += '</div>';

    document.querySelector("#sad64").insertAdjacentHTML("beforeend", html);
}

function removerEscolaridade(id){
    escolas.forEach(function(item, key){
        if(item == id){
            escolas.splice(key,1);
        }
    })
    document.querySelector("#"+id).remove();
}

function registrarEscola(){
    if(escolas.length == 0)
        alert("Adicione as escolaridades da sua escola");
    else{
        let error = false;
        let data = {};
        escolas.forEach(function(item, key){
            let mat = document.querySelector("#mat"+item).checked;
            let ves = document.querySelector("#ves"+item).checked;
            let not = document.querySelector("#not"+item).checked;
            let int = document.querySelector("#int"+item).checked;
            let vagas = document.querySelector("#vagas"+item).value;
            if(!(mat) && !(ves) && !(not) && !(int))
                error = true;
                data[key] = {
                    id: item,
                    escolaridade: document.querySelector("#escolaridade"+item).value,
                    serie: document.querySelector("#serie"+item).value,
                    mat: mat,
                    int: int,
                    ves: ves,
                    not: not,
                    vagas: vagas,
                }
        });

        if(error)
            alert("ATENÇÃO, Escolha pelo menos um turno em cada escola");
        else{
            if(document.querySelector("#input_endereco").value.length == 0){
                alert("Informe o endereço da escola");
            }
            $.ajax({
                url: "/add/school",
                type: "POST",
                data:{
                    nome: document.querySelector("#input_name").value,
                    endereco: document.querySelector("#input_endereco").value,
                    infos: data,
                    "_token": token
                },
                success: function(retorno){
                    if(retorno == "SUCESSO")
                        window.location = "/schools"
                        console.log(retorno);
                    },
                error: function(error){
                    console.log(error);
                    alert("Ops, houve um erro");
                }
            });
        }

    }
}

function modalidadeEscolida(event, id){
    
    let html = "";

    if(event.target.value == 1 || event.target.value == 2){
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
    if(event.target.value == 3){
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
    if(event.target.value == 4){
        html = "<option>Berçário</option>";        
        html += "<option>Infantil 1 (de 1 ano até 1 ano e 11 meses e 29 dias)</option>";  
        html += "<option>Infantil 2 (de 2 ano até 2 ano e 11 meses e 29 dias)</option>";  
        html += "<option>Infantil 3 (de 3 ano até 3 ano e 11 meses e 29 dias)</option>";  
        html += "<option>Infantil 4 (de 4 ano até 4 ano e 11 meses e 29 dias)</option>";  
        html += "<option>Infantil 5 (de 5 ano até 5 ano e 11 meses e 29 dias)</option>";  
    }

    document.querySelector("#serie" + id).innerHTML = html;

}