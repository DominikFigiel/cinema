{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container mb-5">
    {if isset($showing)}
    <!-- Wybór sali -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Tytuł:"{$showing[\Config\Database\DBConfig\Movie::$Title]}" <span class="h3">{$showing[\Config\Database\DBConfig\Showing::$DateTime]}</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h3 class="h3">Wybierz miejsca</h3>
        </div>
    </div>
    <div class="row">
        {if isset($places)}
        <table class="table">
            <tbody>
                {foreach key=$keyRow item=$row from=$places}
                <tr class="text-center">
                    <td>{$keyRow}</td>
                    {foreach key=$keyColumn item=$column from=$row}
                    {if !isset($places[$keyRow][$keyColumn]['busy'])}
                    <td><button type="button" onclick="addCookieFor('places', {$column['id']})" class="btn btn-success">{$keyColumn}</button></td>
                    {else if $places[$keyRow][$keyColumn]['busy'] == false}
                    <td><button type="button" onclick="deleteCookieFor('places', {$column['id']})" class="btn btn-primary">{$keyColumn}</button></td>
                    {else}
                    <td><button type="button" class="btn btn-danger">{$keyColumn}</button></td>
                    {/if}
                    {/foreach}
                    <td>{$keyRow}</td>
                </tr>
                {/foreach}
            </tbody>
        </table>
        {else}
        <h2 class="h2">Nie ma miejsc</h2>
        {/if}
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
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