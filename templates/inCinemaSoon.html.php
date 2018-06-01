{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container mb-5">
    <div class="col-lg-12 text-center">
        <h1 class="mt-5">Wkrótce w kinie</h1>
        <hr/>
    </div>
    {if isset($movies) && count($movies) > 0}
    {foreach from = $movies item = $movie key=$k}
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/covers/{$movie[\Config\Database\DBConfig\Movie::$Cover]}.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-10 col-md-9 col-sm-6 col-6">
            <p><strong><a class="text-dark" href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Szczegóły/{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}"><u>{$movie[\Config\Database\DBConfig\Movie::$Title]}</u></a></strong></p>
            <p>Od lat: {$movie[\Config\Database\DBConfig\Movie::$Age]}</p>
            <p>Gatunek: {assign var = "f" value = false}{foreach from = $movies[$k]['genres'] item = $genre key = $kg}{if $f}, {else}{/if}{$kg}{$f = true}{/foreach}</p>
            <p>Produkcja: {assign var = "f" value = false}{foreach from = $movies[$k]['productions'] item = $production key = $kp}{if $f}, {else}{/if}{$kp}{$f = true}{/foreach}</p>
        </div>
    </div>
    <hr/>
    {/foreach}
    {else}
    <div class="col-lg-12 text-center">
        <h4 class="mt-5 text-center text-info">Brak nowych filmów</h4>
    </div>
    {/if}
</div>
{/block}