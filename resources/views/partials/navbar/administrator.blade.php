<nav class="navbar navbar-expand-lg navbar-dark">
    @guest
        <a class="navbar-brand" href="https://majesticeducacion.com.mx/">
            <img src="{{ asset('images/logoMajestic.svg') }}" class="logo" alt="Majestic Education"/>
            <label>MED Majestic Education Digital</label>
        </a>
    @else
        <a class="navbar-brand" href="{{ route('materials.home') }}">
            <img src="{{ asset('images/logoMajestic.svg') }}" class="logo" alt="Majestic Education"/>
            <label>MED Majestic Education Digital</label>
        </a>
    @endguest
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a id="liTitle" class="nav-link" href="{{ route('administrator.home') }}">{{ __('Libros') }}</a>
            </li>
            <li class="nav-item">
                <a id="liTitle" class="nav-link" href="{{ route('administrator.users') }}">{{ __('Usuarios') }}</a>
            </li>
            @include('partials.navbar.logout')
        </ul>
    </div>
</nav>