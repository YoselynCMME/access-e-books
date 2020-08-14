<div class="card">
    <div class="card-header">
        CloudBooks
    </div>
    <div class="card-body">
        <div class="row">
            @forelse($books as $book)
                <div class="col-md-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            @if(auth()->user()->role_id === 3)
                                <h4>{{ $book['student']['book'] }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a class="btn" id="btnMBook" href="{{ route('books.get_book', [$book['student']['slug']]) }}">
                                            <i style="font-size:30px;" class="fa fa-book"></i><br>
                                            {{ $book['student']['category'] === 'comun' ? 'Libro proyectable':'Projectable book' }} 
                                        </a>
                                        <a class="btn mt-2" id="btnMBook" href="{{ $book['teacher'] !== null ? route('books.get_book', [$book['teacher']['slug']]):'#' }}">
                                            <i style="font-size:30px;" class="fa fa-book"></i><br>
                                            {{ $book['student']['category'] === 'comun' ? 'Guía del maestro':"Teacher's Guide" }} 
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        @include('partials.materials.digital-learning', ['book' => $book['student']])
                                    </div>
                                </div>
                            @else
                                <h4><b>{{ $book['book'] }}</b></h4>
                                <h5>
                                    {{ $book['category'] === 'comun' ? 'Aprendizaje Digital':'Digital Learning' }}
                                </h5>
                                @include('partials.materials.books-student', ['book' => $book])
                            @endif
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
