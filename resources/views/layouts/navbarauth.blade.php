<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="/home">Início</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/listar/pisciculturas">Minhas Pisciculturas</a>
        </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
        <ul>
            <div class="nav-item dropdown">
                <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{\Auth::user()->name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">Sair</a>
                </div>
            </div>
        </ul>
    </div>
    <!---
    <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    -->    

</div>