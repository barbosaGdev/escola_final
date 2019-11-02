<div class="flex-center flex-wrap">
    <a href="/citys"><button class="button-big darkyellow">Cidades</button></a>
    <a href="/schools"><button class="button-big darkblue">Escolas</button></a>
    <a href="/cad/user"><button class="button-big darkyellow">Cadastrar usuário</button></a>
    <a href="/start"><button class="button-big darkblue">START</button></a>
    <a href="/vincular"><button class="button-big darkyellow">Vincular candidato</button></a>
    @if(isset($_SESSION['adm']))
    <a href="/logout"><button class="button-big darkred">Logout</button></a>
    @endif
</div>