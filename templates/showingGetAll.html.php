{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<!-- Treść strony -->
<div class="container mb-5">

    <!-- Kalendarz -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Repertuar</h1>
            {if isset($calendar)}
            <p class="lead">Kalendarz</p>
            {foreach from=$calendar key=$i item=$day}
            {if $day|date_format:"%Y-%m-%d" == $setDate|date_format:"%Y-%m-%d"}
            <button  onclick="setCookie('dateGetAll', {$i})" class="btn btn-primary mb-1">{($day|date_format:"%A")}</br>{($day|date_format:"%e %B")}</button>
            {else}
            <button  onclick="setCookie('dateGetAll', {$i})" class="btn btn-secondary mb-1">{($day|date_format:"%A")}</br>{($day|date_format:"%e %B")}</button>
            {/if}
            {/foreach}
            {/if}
            <hr/>
        </div>
    </div>
    <!-- Rodzaj seansu -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="lead">Rodzaj seansu</p>
            {if isset($types)}
            {foreach $types as $type}
            {$tmp = $type[\Config\Database\DBConfig\Type::$Type]}
            <button value="{$type[\Config\Database\DBConfig\Type::$Type]}" onclick="setCookie('typeGetAll', value)" {if $type[\Config\Database\DBConfig\Type::$Type] == $typeIn}class="btn btn-primary"{else}class="btn btn-outline-secondary"{/if}>{$type[\Config\Database\DBConfig\Type::$Type]}</button>
            {/foreach}
            {/if}
            <button onclick="setCookie('typeGetAll', 'All')" {if 'All' === $typeIn}class="btn btn-primary"{else}class="btn btn-outline-secondary"{/if}>Wszystkie</button>
            <hr/>
        </div>
    </div>

    <!-- Filmy -->
    {foreach $showings as $types}
    {foreach $types as $dubbings}
    {foreach $dubbings as $movie}
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/covers/{$movie[\Config\Database\DBConfig\Movie::$Cover]}.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-6 col-md-5 col-sm-6 col-6">
            <p><strong><a class="text-dark" href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Szczegóły/{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}"><u>{$movie[\Config\Database\DBConfig\Movie::$Title]}</u></a></strong> ({$movie[\Config\Database\DBConfig\Type::$Type]} , {if $movie[\Config\Database\DBConfig\Showing::$Dubbing] == 1}Dubbing{else}Napisy{/if}) Wersja językowa: {$movie[\Config\Database\DBConfig\LanguageVersion::$Version]}</p>
            <p>Od lat: {$movie[\Config\Database\DBConfig\Movie::$Age]}</p>
            <p>Czas trwania: {$movie[\Config\Database\DBConfig\Movie::$DurationTime]}</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-sm-3 mt-sm-3 mt-md-0">
            <div class="text-center text-md-left">
                {foreach $movie['hours'] as $hour}
                <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Rezerwacja/Miejsce/Seans/{$movie[\Config\Database\DBConfig\Showing::$IdShowing]}" title="Zarezerwuj bilet" class="btn btn-outline-primary m-1 mt-3 mt-md-1">{$hour|date_format:'%H:%M'}</a>
                {/foreach}
            </div>
        </div>
    </div>
    <hr/>
    {/foreach}
    {/foreach}
    {/foreach}

    <!-- Pamiętać usunąć -->
    {if isset($error)}
    <div>
        <h4 class="h4">{$error}</h4>
    </div>
    {/if}

    <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Dodaj" title="Zarezerwuj bilet" class="btn btn-outline-primary m-1 mt-3 mt-md-1">Add</a>

</div>
{/block}