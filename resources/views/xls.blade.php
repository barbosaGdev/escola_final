<meta charset='UTF-8'>
<div id="all">
    <table>
        <thead>
            <tr>
                <td>Nome do candidato</td>
                <td>CPF</td>
                <td>RG</td>
                <td>Nome do pai</td>
                <td>Nome da mãe</td>
                <td>Nome do responsável</td>
                <td>CPF do responsável</td>
                <td>Data de nascimento</td>
                <td>Celular</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach($candidatos as $item)
            <tr>
                <td>{{$item->nome}}</td>
                <td>{{$item->cpf}}</td>
                <td>{{$item->rg}}</td>
                <td>{{$item->nome_pai}}</td>
                <td>{{$item->nome_mae}}</td>
                <td>{{$item->nome_responsavel}}</td>
                <td>{{$item->CPF_responsavel}}</td>
                <td>{{date("d/m/Y", $item->data_nascimento)}}</td>
                <td>{{$item->cel}}</td>
                <td>{{$item->status}}</td>
            </tr>
            @endforeach()
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    window.open('data:application/vnd.ms-excel,' + $('#all').html());
</script>
