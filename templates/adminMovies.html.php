{extends file="templates/adminGlobalTemplate.html.php"}
{block name="content"}
<div class="container">
    <h1 class="h4 text-center">Zarządzanie filmami</h1>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a class="btn btn-success" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/Dodaj/" title="Dodaj film">Dodaj film</a>
            <hr/>
        </div>
    </div>
    <div id="data">
    {foreach $movies as $movie}
    <div id="item" class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/covers/{$movie[\Config\Database\DBConfig\Movie::$Cover]}.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-8 col-md-5 col-sm-6 col-6">
            <p><strong><a class="text-dark" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/Szczegóły/{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}"><u>{$movie[\Config\Database\DBConfig\Movie::$Title]}</u></a></strong></p>
            <p>Data premiery: {$movie[\Config\Database\DBConfig\Movie::$ReleaseDate]}</p>
            <p>Produkcja: {if isset($movie['productions'])}{foreach from=$movie['productions'] key=$k item=$production}{if $production > 1}, {else}{/if}{$k}{/foreach}{else}Brak informacji{/if}</p>
            <p>Gatunek: {if isset($movie['genres'])}{foreach from=$movie['genres'] key=$k item=$genre}{if $genre > 1}, {else}{/if}{$k}{/foreach}{else}Brak informacji{/if}</p>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12 col-12 mt-sm-3 mt-sm-3 mt-md-0">
            <div class="text-center text-md-left">
                <a href="http://{$smarty.server.HTTP_HOST}{$subdir}" title="Edytuj" class="btn btn-outline-primary m-1 mt-3 mt-md-1">Edytuj</a>
                <a class="btn btn-outline-danger m-1 mt-3 mt-md-1 text-danger" data-toggle="modal" data-target="#modal_delete" data-href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/" value="{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}" title="Usuń" class="btn btn-outline-danger m-1 mt-3 mt-md-1">Usuń</a>
            </div>
        </div>
    </div>
    <hr/>
    {/foreach}
    </div>
    <hr/>
    <hr/>
</div>
{/block}