<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            Libros guardados
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($books as $book)
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-body">
                                <a class="btn" id="btnMBook" href="{{ route('books.get_book', [$book->slug]) }}">
                                    <i style="font-size:30px;" class="fa fa-book"></i><br>
                                    {{ $book->book }}
                                </a>
                                <hr>
                                <a class="btn" id="btnMaterials" data-toggle="modal" data-target="#modal-materials">
                                    <i class="fa fa-star"></i>
                                    Materials
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-materials" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Materials</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a id="btnMaterial" class="btn" href="{{ route('materials.extra', [$book->id]) }}">
                                                            <i class="fa fa-cubes"></i><br>
                                                            Lessons
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a id="btnMaterial" class="btn" href="{{ $book->link_games }}">
                                                            <i class="fa fa-gamepad"></i><br>
                                                            Games
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <a id="btnMaterial" class="btn" href="#">
                                                            <i class="fa fa-download"></i><br>
                                                            Downloadable material
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a id="btnMaterial" class="btn" href="#">
                                                            <i class="fa fa-bank"></i><br>
                                                            Reagent Bank
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
