
<header class="header">
    <nav class="header__nav nav navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <a class="nav__company navbar-brand" href="{{ route('main_browse') }}">Laravel-immo</a>
        <button class="nav__toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="nav_menu menu collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="menu__list navbar-nav">
                <li class=" nav-item">
                    <a class="menu__list__item nav-link" href="{{ route('admin_annonces_browse') }}">Administration</a>
                </li>
            </ul>
            @guest
                <a href="{{ route('login') }}" class="btn btn-info">Se connecter</a>
            @endguest
            @auth
                <div>Connecté en tant que {{ Auth::user()->name }}</div>
                <form action="{{ route('logout') }}" method="POST" class="ml-2">
                    @csrf
                    <button type="submit" class="btn btn-info">Logout</button>
                </form>
            @endauth
        </div>
    </nav>
</header>
