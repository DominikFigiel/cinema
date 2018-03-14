{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<!-- Treść strony -->
<div class="container mb-5">

    <!-- Naglowek -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Baza filmów</h1>
            <hr/>
        </div>
    </div>

    <!-- Filmy -->
    {foreach $movies as $movie}
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <img src="resources/images/covers/black-panther.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-6 col-md-5 col-sm-6 col-6">
            <p><strong><a class="text-dark" href="http://{$smarty.server.HTTP_HOST}{$subdir}index.php?controller=Movie&action=getOne&id={$movie[\Config\Database\DBConfig\Movie::$IdMovie]}"><u>{$movie[\Config\Database\DBConfig\Movie::$Title]}</u></a></strong> (2D, Dubbing)</p>
            <p>Od lat: {$movie[\Config\Database\DBConfig\Movie::$Age]}</p>
            <p>Czas trwania: {$movie[\Config\Database\DBConfig\Movie::$DurationTime]}</p>
        </div>
    </div>
    <hr/>
    {/foreach}

</div>
{/block}