{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<!-- Treść strony -->
<div class="container mb-5">

    <!-- Tytuł filmu i data premiery -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">{$movie[\Config\Database\DBConfig\Movie::$Title]}</h1>
            <p class="lead">Data premiery: {$movie[\Config\Database\DBConfig\Movie::$ReleaseDate]}</p>
            <hr/>
        </div>
    </div>

    <!-- Opis -->
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/covers/{$movie[\Config\Database\DBConfig\Movie::$Cover]}.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 pb-5 mt-3 mt-md-0">
            <p><strong>Gatunek:</strong> {if $genres}{foreach from=$genres key=$k item=$genre}{$genre[\Config\Database\DBConfig\Genre::$GenreName]} {if $k < $genres|count-1}, {else}{/if}{/foreach}{else} Brak informacji{/if}</p>
            <p><strong>Od lat:</strong> {$movie[\Config\Database\DBConfig\Movie::$Age]}</p>
            <p><strong>Czas trwania:</strong> {$movie[\Config\Database\DBConfig\Movie::$DurationTime]} minut</p>
            <p><strong>Produkcja:</strong> {if $productions}{foreach from=$productions key=$k item=$production}{$production[\Config\Database\DBConfig\Production::$Country]} {if $k < $productions|count-1}, {else}{/if}{/foreach}{else} Brak informacji{/if}</p>
            <p><strong>Obsada:</strong> {if $actors}{foreach from=$actors key=$k item=$actor}{$actor[\Config\Database\DBConfig\Actor::$FirstName]} {$actor[\Config\Database\DBConfig\Actor::$LastName]} ({$actor[\Config\Database\DBConfig\Cast::$Role]}) {if $k < $actors|count-1}, {else}{/if}{/foreach}{else} Brak informacji{/if}</p>
            <p><strong>Opis filmu:</strong></p>
            <p>{$movie[\Config\Database\DBConfig\Movie::$Description]}</p>
        </div>
    </div>

    <hr/>

    <!-- Aktualny repertuar - link -->
    <div class="text-center pb-4">
        <a href="http://{$smarty.server.HTTP_HOST}{$subdir}"><button type="button" class="btn btn-primary btn-lg">Zobacz aktualny repertuar</button></a>
    </div>

</div>
{/block}