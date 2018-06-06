{extends file="templates/adminGlobalTemplate.html.php"}
{block name="content"}
<div class="container col-lg-12 col-md-12" xmlns:>
    <h1 class="h4 text-center">Edytowanie seansu</h1>
    <form class="container cent col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <div class="form-group text-center">
            <label>Sala: </label>
            {foreach $cinemaHalls as $cinemaHall}
            <button {if $idCinemaHall && $cinemaHall[\Config\Database\DBConfig\CinemaHall::$IdCinemaHall] == $idCinemaHall} class="btn btn-primary" {else} class="btn btn-secondary" {/if} onclick="setCookie('idCinemaHallEdit', {$cinemaHall[\Config\Database\DBConfig\CinemaHall::$IdCinemaHall]})">{$cinemaHall[\Config\Database\DBConfig\CinemaHall::$Name]}</button>
            {/foreach}
        </div>
        <div class="form-group text-center">
            <label>Film: </label>
            <select id="movies" name="movies" required onchange="setCookie('idMovieEdit', value)">
                {foreach $movies as $movie}
                <option {if $movie[\Config\Database\DBConfig\Movie::$IdMovie] == $idMovie}selected{/if} value="{$movie[\Config\Database\DBConfig\Movie::$IdMovie]}">{$movie[\Config\Database\DBConfig\Movie::$Title]}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group text-center">
            <label>Typ filmu: </label>
            {foreach $typesForMovie as $typeForMovie}
            <label><input type="radio" id="movieType" name="movieType" onclick="setCookie('idTypeEdit', {$typeForMovie[\Config\Database\DBConfig\Type::$IdType]})" {if $typeForMovie[\Config\Database\DBConfig\Type::$IdType] == $idTypeMovie}checked{/if} value="{$typeForMovie[\Config\Database\DBConfig\Type::$IdType]}">{$typeForMovie[\Config\Database\DBConfig\Type::$Type]}</label>
            {/foreach}
        </div>
        <div class="form-group text-center">
            <input id="dubbing" name="dubbing" onclick="setCookieDubbing('dubbingEdit')" type="checkbox" {if $dubbing}checked{/if}/>Dubbing
        </div>
        <div class="form-group text-center">
            <label>Dzień: </label>
            <input type="date" id="date" name="date" required onchange="setCookie('dateAdminEdit', value)" value="{$date|date_format:'%Y-%m-%d'}"/>

        </div>
        <div class="form-group text-center">
            <label>Godzina: </label>
            <input type="time" id="time" name="time" value="{$date|date_format:'%H:%M'}" required onchange="setCookie('timeEdit',value)"/>
        </div>
        <div class="form-group text-center">
            <a class="btn btn-success" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse/Edytowanie">Zapisz</a>
            <a class="btn btn-danger" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse">Wróć</a>
        </div>
    </form>
</div>
{/block}