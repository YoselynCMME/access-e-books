@if($book['category'] === 'english')
    <a id="btnSimple" class="btn mt-2" href="{{ $book['link_games'] }}">
        <i class="fa fa-gamepad"></i> Games
    </a>
@endif
@if($book['link_lessons'] !== '#')
    <a id="btnSimple" class="btn mt-2" href="{{ $book['link_lessons'] }}">
        <i class="fa fa-cubes"></i> 
        {{ $book['category'] === 'comun' ? 'Lecciones':'Lessons' }}
    </a>
@endif
<a id="btnSimple" class="btn mt-2" target="_blank" href="http://generate-exam-demo.herokuapp.com/login">
    <i class="fa fa-bank"></i>
    {{ $book['category'] === 'comun' ? 'Banco de reactivos':'Reagent Bank' }}
</a>
<a id="btnSimple" class="btn mt-2" target="_blank" href="https://majesticeducationdigital.com/moodle/login/index.php">
    <i class="fa fa-download"></i>
    {{ $book['category'] === 'comun' ? 'Material descargable':'Downloadable material' }}
</a>