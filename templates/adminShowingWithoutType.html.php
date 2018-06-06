{extends file="templates/adminGlobalTemplate.html.php"}
{block name="content"}
<div class="container">
    <h1 class="h4 text-center">Zarządzanie typami</h1>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a class="btn btn-success" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse/Dodaj" title="Dodaj seans">Dodaj seans</a>
            <a class="btn btn-info" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy" title="Zarządzanie filmami">Zarządzanie filmami</a>
            <hr/>
        </div>
    </div>
    <div id="data">
        {foreach $movies as $movie}
        <div id="item" class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/covers/{$movie[\Config\Database\DBConfig\Movie::$Cover]}.jpg?nocache={$time}" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                <p><strong><a class="text-dark" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/Szczegóły/{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}"><u>{$movie[\Config\Database\DBConfig\Movie::$Title]}</u></a></strong></p>
                <p>Data premiery: {$movie[\Config\Database\DBConfig\Movie::$ReleaseDate]}</p>
                <p>Produkcja: {if isset($movie['productions'])}{foreach from=$movie['productions'] key=$k item=$production}{if $production > 1}, {else}{/if}{$k}{/foreach}{else}Brak informacji{/if}</p>
                <p>Gatunek: {if isset($movie['genres'])}{foreach from=$movie['genres'] key=$k item=$genre}{if $genre > 1}, {else}{/if}{$k}{/foreach}{else}Brak informacji{/if}</p>
            </div>
            <div class="text-center col-lg-3 col-md-5 col-sm-12 col-12 mt-sm-3 mt-sm-3 mt-md-0">
                {if isset($types)}
                    <form action="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/BezTypu/Ustaw/{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}" method="post">
                        {foreach $types as $type}
                            <input id="type[]" name="type[]" type="checkbox" value="{$type[\Config\Database\DBConfig\Type::$IdType]}"/>{$type[\Config\Database\DBConfig\Type::$Type]}
                        {/foreach}
                         <button class="btn btn-outline-primary m-1 mt-3 mt-md-1" type="submit">Ustaw</button>
                    </form>
                {/if}
            </div>
        </div>
        <hr/>
        {/foreach}
    </div>
    <hr/>
    <hr/>
</div>
{/block}