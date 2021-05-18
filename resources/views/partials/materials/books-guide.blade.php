<div class="card">
    <div class="card-header">
        CloudBooks
    </div>
    <div class="card-body">
        <div class="row">
            @forelse($books as $book)
                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h4>{{ substr($book['book'], 8, 50) }}</h4>
                            <a class="btn mt-2" id="btnMBook" href="{{ route('books.get_book', [$book['slug']]) }}">
                                <i style="font-size:30px;" class="fa fa-book"></i><br>
                                {{ $book['category'] === 'comun' ? 'Guía del maestro':"Teacher's Guide" }} 
                            </a>
                        </div>
                    </div><br>
                </div>
            @empty
                <div class="alert alert-dark" role="alert">
                    <i class="fa fa-info-circle"></i> No tienes libros guardados
                </div>
            @endforelse
        </div>
    </div>
</div>
