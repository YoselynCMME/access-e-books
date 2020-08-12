@if($book['category'] === 'english')
    <div class="row">
        <div class="col-md-6">
            <a id="btnMaterialSt" class="btn" href="{{ $book['link_lessons'] }}">
                <i class="fa fa-cubes"></i><br>
                Lessons
            </a>
        </div>
        <div class="col-md-6">
            <a id="btnMaterialSt" class="btn" href="{{ $book['link_games'] }}">
                <i class="fa fa-gamepad"></i><br>
                Games
            </a>
        </div>
    </div>
    <div class="mt-2 text-center">
        <a id="btnMaterialSt" class="btn" target="_blank" href="https://majesticeducationdigital.com/moodle/login/index.php">
            <i class="fa fa-download"></i><br>
            {{ $book['category'] === 'comun' ? 'Material descargable':'Downloadable material' }}
        </a>
    </div>
@else
    @if($book['link_lessons'] !== '#')
        <div class="row">
            <div class="col-md-6">
                <a id="btnMaterialSt" class="btn" href="{{ $book['link_lessons'] }}">
                    <i class="fa fa-cubes"></i><br>
                    Lessons
                </a>
            </div>
            <div class="col-md-6">
                <a id="btnMaterialSt" class="btn" target="_blank" href="https://majesticeducationdigital.com/moodle/login/index.php">
                    <i class="fa fa-download"></i><br>
                    {{ $book['category'] === 'comun' ? 'Material descargable':'Downloadable material' }}
                </a>
            </div>
        </div>
    @else
        <a id="btnMaterialSt" class="btn" target="_blank" href="https://majesticeducationdigital.com/moodle/login/index.php">
            <i class="fa fa-download"></i><br>
            {{ $book['category'] === 'comun' ? 'Material descargable':'Downloadable material' }}
        </a>
    @endif
@endif
