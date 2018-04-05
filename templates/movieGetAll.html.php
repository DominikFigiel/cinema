{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<!-- Treść strony -->
<div class="container mb-5">

    <!-- Naglowek -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Repertuar</h1>
            <hr/>
        </div>
    </div>

    <!-- Filmy -->
    {foreach $showings as $movie}
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/covers/{$movie[\Config\Database\DBConfig\Movie::$Cover]}.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-6 col-md-5 col-sm-6 col-6">
            <p><strong><a class="text-dark" href="http://{$smarty.server.HTTP_HOST}{$subdir}Movie/Details/{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}"><u>{$movie[\Config\Database\DBConfig\Movie::$Title]}</u></a></strong> ({$movie[\Config\Database\DBConfig\Type::$Type]} , {if $movie[\Config\Database\DBConfig\Showing::$Dubbing] == 1}Dubbing{else}Napisy{/if}) Wersja językowa: {$movie[\Config\Database\DBConfig\LanguageVersion::$Version]}</p>
            <p>Od lat: {$movie[\Config\Database\DBConfig\Movie::$Age]}</p>
            <p>Czas trwania: {$movie[\Config\Database\DBConfig\Movie::$DurationTime]}</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-sm-3 mt-sm-3 mt-md-0">
            <div class="text-center text-md-left">
                <button type="button" class="btn btn-outline-primary m-1 mt-3 mt-md-1">{$movie[\Config\Database\DBConfig\Showing::$DateTime]|date_format:'%H:%M'}</button>
            </div>
        </div>
    </div>
    <hr/>
    {/foreach}

</div>
{/block}