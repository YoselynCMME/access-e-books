<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            Libros guardados
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($books as $book)
                    <div class="col-md-3">
                        <a class="btn" id="btnBook" href="{{ route('books.get_book', [$book->slug]) }}">
                            <i style="font-size:30px;" class="fa fa-book"></i><br>
                            {{ $book->book }}
                        </a>
                    </div>
                @empty
                <div class="alert alert-dark" role="alert">
                    <i class="fa fa-info-circle"></i> No tienes libros guardados
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
