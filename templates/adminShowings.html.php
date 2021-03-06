{extends file="templates/adminGlobalTemplate.html.php"}
{block name="content"}
<div class="container">
    <h1 class="h4 text-center">Zarządzanie seansami</h1>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a class="btn btn-success" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse/Dodaj">Dodaj seans</a>
            <hr/>
        </div>
    </div>
    <!-- Kalendarz -->
    <div class="row">
        <div class="col-lg-12 text-center">
            {if isset($calendar)}
            <p class="lead">Kalendarz</p>
            {foreach from=$calendar key=$i item=$day}
            {if $day|date_format:"%Y-%m-%d" == $setDate|date_format:"%Y-%m-%d"}
            <button onclick="setCookie('dateAdminGetAll', {$i})" class="btn btn-primary mb-1">{($day|date_format:"%e %B")}</button>
            {else}
            <button onclick="setCookie('dateAdminGetAll', {$i})" class="btn btn-secondary mb-1">{($day|date_format:"%e %B")}</button>
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
            <button value="{$type[\Config\Database\DBConfig\Type::$Type]}" onclick="setCookie('typeAdminGetAll', value)" {if $type[\Config\Database\DBConfig\Type::$Type] == $typeIn}class="btn btn-primary"{else}class="btn btn-outline-secondary"{/if}>{$type[\Config\Database\DBConfig\Type::$Type]}</button>
            {/foreach}
            {/if}
            <button onclick="setCookie('typeAdminGetAll', 'All')" {if 'All' === $typeIn}class="btn btn-primary"{else}class="btn btn-outline-secondary"{/if}>Wszystkie</button>
            <hr/>
        </div>
    </div>

    <!-- Rodzaj sali -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="lead">Sala</p>
            {if isset($cinemaHalls)}
            {foreach $cinemaHalls as $cinemaHall}
            {$tmp = $cinemaHall[\Config\Database\DBConfig\CinemaHall::$Name]}
            <button value="{$cinemaHall[\Config\Database\DBConfig\CinemaHall::$Name]}" onclick="setCookie('cinemaHallGetAll', value)" {if $cinemaHall[\Config\Database\DBConfig\CinemaHall::$Name] == $cinemaHallIn}class="btn btn-primary"{else}class="btn btn-outline-secondary"{/if}>{$cinemaHall[\Config\Database\DBConfig\CinemaHall::$Name]}</button>
            {/foreach}
            {/if}
            <button onclick="setCookie('cinemaHallGetAll', 'All')" {if 'All' === $cinemaHallIn}class="btn btn-primary"{else}class="btn btn-outline-secondary"{/if}>Wszystkie</button>
            <hr/>
        </div>
    </div>

    <!-- Filmy -->
    <div id="data">
    {foreach $showings as $types}
    {foreach $types as $dubbings}
    {foreach $dubbings as $movie}
    <div id="item" class="row">
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
                {foreach from = $movie['hours'] item = $hour key = $k}
                <div class="row">
                    <div class="btn btn-outline-info m-1 mt-3 mt-md-1 text-primary">{$hour['hour']|date_format:'%H:%M'}</div>
                    <a class="btn btn-outline-info m-1 mt-3 mt-md-1 text-info" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse/Edytuj/{$k}">Edytuj</a>
                    <a class="btn btn-outline-danger m-1 mt-3 mt-md-1 text-danger" data-toggle="modal" data-href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse/" value="{$k}" data-target="#modal_delete">Usuń</a>
                </div>
                {/foreach}
            </div>
        </div>
    </div>
    <hr/>
    {/foreach}
    {/foreach}
    {/foreach}
    </div>
</div>
{/block}