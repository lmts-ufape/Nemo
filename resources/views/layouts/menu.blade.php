<div id="menu">
    @if(Auth::check())
        <div id="menu-esquerda">
                <a href="/home">Início</a>
        </div>
        <div id ="menu-direita">
                <a href="/logout">Sair</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @else
        <div id="menu-direita-login">
        <a href="{{route('login')}}">Entrar &nbsp;</a> <a href="{{route('register')}}">Registrar</a>
        </div>
    @endif
</div>