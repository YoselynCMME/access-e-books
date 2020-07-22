<!-- Modal -->
<div class="modal fade" id="modal-materials" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Digital Learning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                    <!-- {{ route('materials.extra', [$book->id]) }} -->
                        <a id="btnMaterial" class="btn" href="{{ $book->link_lessons }}">
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
                <div class="mt-2 text-center">
                    <a id="btnMaterial" class="btn" target="_blank" href="https://majesticeducationdigital.com/moodle/login/index.php">
                        <i class="fa fa-download"></i><br>
                        Downloadable material
                    </a>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>