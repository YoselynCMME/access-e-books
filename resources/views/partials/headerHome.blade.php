<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="https://majesticeducacion.com.mx/">
        <img src="{{ asset('images/logoMajestic.svg') }}" class="logo" alt="Majestic Education"/>
        <label>MED Majestic Education Digital</label>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('login') }}">Iniciar sesión</a>
            </li>
        </ul>
    </div>
</nav>