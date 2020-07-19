<div class="row text-center">
    @foreach($books as $book)
        <div class="col-md">
            <a id="btnLevel" class="btn" href="{{ route('promociones.category', ['todo'=> $todo, 'slug'=>$book['slug']]) }}">
                <i class="fa fa-book"></i><br>
                {{ $book['category'] }}
            </a>
        </div>
    @endforeach
</div>