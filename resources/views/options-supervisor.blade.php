<div class="flex-center flex-wrap">
    <a href="/show/schools"><button class="button-big darkblue">Escolas</button></a>
    <a href="/vincular"><button class="button-big darkyellow">Vincular candidato</button></a>
    <a href="/adm"><button class="button-big darkyellow">Voltar</button></a>
    @if(isset($_SESSION['user']))
        <a href="/logout"><button class="button-big darkred">Logout</button></a>
    @endif
</div>