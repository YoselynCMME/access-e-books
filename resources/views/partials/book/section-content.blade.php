<div class="row text-center">
    @foreach($books as $book)
        <div class="col-md">
            <a id="btnLevel" class="btn" href="{{ route('promociones.book', ['todo'=>$todo, 'id'=>$b['id'], 'book'=>$book->slug]) }}">
                <i class="fa fa-book"></i><br>
                {{ $book->book }}
            </a>
        </div>
    @endforeach
    @if(strstr($book->slug, 'p-e'))
        <hr>
        <a id="btnLevel" class="btn" href="">
            <i class="fa fa-caret-square-o-right"></i><br>
            Presentation
        </a>
    @endif
</div>