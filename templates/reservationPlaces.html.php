{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container mb-5">
    {if isset($showing)}
    <!-- Wybór sali -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Tytuł:"{$showing[\Config\Database\DBConfig\Movie::$Title]}" <span class="h3">{$showing[\Config\Database\DBConfig\Showing::$DateTime]|date_format:'%Y-%m-%d %H:%M'}</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center mb-3">
            <h3 class="h3">Wybierz miejsca</h3>
            {if isset($admin) && $admin === true}
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Rezerwacje/" class="btn btn-outline-danger text-center">Wróć</a>
            {/if}
        </div>
    </div>
    {if isset($places)}
        {foreach key=$keyRow item=$row from=$places}
        <div class="row">
            <div class="text-center col-lg-12 mb-2">
                <div class="d-inline mr-2">{$keyRow}</div>
                {foreach key=$keyColumn item=$column from=$row}
                {if !isset($places[$keyRow][$keyColumn]['busy'])}
                <div class="d-inline mr-2">
                    <button type="button" onclick="addCookieFor('places', {$column['id']})" class="btn btn-success btn-seat">{$keyColumn}</button>
                </div>
                <script type="text/javascript">
                    addPlace({$column['id']});
                </script>
                {else if $places[$keyRow][$keyColumn]['busy'] == false}
                <div class="d-inline mr-2">
                    <button type="button" onclick="deleteCookieFor('places', {$column['id']})" class="btn btn-primary btn-seat">{$keyColumn}</button>
                </div>
                <script type="text/javascript">
                    addPlace({$column['id']});
                </script>
                {else}
                {assign "busy" true}
                <div class="d-inline mr-2">
                    <button type="button" class="btn btn-danger btn-seat">{$keyColumn}</button>
                </div>
                {/if}
                {/foreach}
                <div class="d-inline mr-2">{$keyRow}</div>
            </div>
        </div>
        {/foreach}
    {else}
    <h2 class="h2">Nie ma miejsc</h2>
    {/if}
    <div class="row">
        <div class="col-lg-12 text-center mt-3">
            <button type="button" class="btn btn-danger text-right" onclick="deleteAllCookieFor('places')">Wyczyść</button>
            {if isset($admin) && $admin === true && !isset($busy)}
            <button type="button" class="btn btn-primary text-right" onclick="addAllPlacesCookieFor('places')">Zarezerwuj całą salę</button>
            {/if}
            {if isset($admin) && $admin === true && isset($busy)}
            <button type="button" class="btn btn-primary text-right" onclick="addAllPlacesCookieFor('places')">Zarezerwuj resztę miejsc</button>
            {/if}
            {if isset($placesReservation)}
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Rezerwacja/DaneKontaktowe/Seans/{$idShowing}" class="btn btn-primary text-right">Dalej</a>
            {else}
            <button class="btn btn-dark text-right">Dalej</button>
            {/if}
        </div>
    </div>
    {else}
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Nie można zarezerwować biletu</h1>
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}">Powrót</a>
        </div>
    </div>
    {/if}
</div>
{/block}