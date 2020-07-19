<div class="container text-left">
    <a href="{{ route('promociones.category', ['todo'=> $todo, 'slug'=>$b['slug']]) }}" class="btn btn-dark">
        <i class="fa fa-arrow-left"></i> {{ $b['type'] === 'comun' ? 'Regresar':'Go back' }}
    </a>
</div>