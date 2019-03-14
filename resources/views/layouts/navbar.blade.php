<nav class="navbar navbar-default" style="background-color: #1B2E4F; border-color: #d3e0e9" role="navigation">
    <div>
        @if(Auth::check())
        <a style="color:#fff" class="nav-link" href="/home">Início</a> @endif
    </div>
    <div>
        @if(Auth::check())
        <a style="color:#fff" href="/logout">Sair</a> @else
        <a style="color:#fff" href="/login">Entrar &nbsp;</a>
        <a style="color:#fff" href="/register">Cadastrar</a> @endif
    </div>
</nav>