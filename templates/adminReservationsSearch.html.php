{extends file="templates/adminReservations.html.php"}
{block name="reservation"}
<div class="container col-lg-12 col-md-12" xmlns:>
    <h1 class="h4 text-center text-info">Szukanie rezerwacji</h1>
    <div class="col-lg-12 text-center">
        {if isset($calendar)}
        <p class="lead">Kalendarz</p>
        {if !isset($setDate) || $setDate === '' || $setDate === null}
        <button  onclick="setCookie('dateGetAll', '')" class="btn btn-primary mb-1">Wszystkie</button>
        {else}
        <button  onclick="setCookie('dateGetAll', '')" class="btn btn-secondary mb-1">Wszystkie</button>
        {/if}
        {foreach from=$calendar key=$i item=$day}
        {if isset($setDate) && $setDate !== null && $day|date_format:"%Y-%m-%d" == $setDate|date_format:"%Y-%m-%d"}
        <button  onclick="setCookie('dateGetAll', {$i})" class="btn btn-primary mb-1">{($day|date_format:"%A")}</br>{($day|date_format:"%e %B")}</button>
        {else}
        <button  onclick="setCookie('dateGetAll', {$i})" class="btn btn-secondary mb-1">{($day|date_format:"%A")}</br>{($day|date_format:"%e %B")}</button>
        {/if}
        {/foreach}
        {/if}
    </div>
    <hr/>
    <!-- Dane użytkownika -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="lead">Dane użytkownika</p>
            <form>
                <input type="text" value="{if isset($firstName) && $firstName !== null}{$firstName}{/if}" name="firstName" id="firstName" placeholder="Imię"/>
                <input type="text" value="{if isset($lastName) && $lastName !== null}{$lastName}{/if}" name="lastName" id="lastName" placeholder="Nazwisko"/>
                <input type="email" value="{if isset($email) && $email !== null}{$email}{/if}" name="email" id="email" placeholder="Email"/>
                <input type="number" value="{if isset($mobilePhone) && $mobilePhone !== null}{$mobilePhone}{/if}" name="mobilePhone" id="mobilePhone" placeholder="Numer telefonu"/>
                <button type="submit" onclick="searchReservation('firstName', 'lastName', 'email', 'mobilePhone')" class="btn btn-outline-primary">Szukaj</button>
                <button type="reset" onclick="clearSearchReservation()" class="btn btn-outline-danger">Wyczyść</button>
            </form>
            <hr/>
        </div>
    </div>
    {if isset($reservations)}
    {foreach from=$reservations item=$reservation key=$k}
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/covers/{$reservation['data'][\Config\Database\DBConfig\Movie::$Cover]}.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-8 col-md-7 col-sm-6 col-6">
            <h4><strong><a class="text-dark h2" href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Szczegóły/{$reservation['data'][\Config\Database\DBConfig\Movie::$IdMovie]}"><u>{$reservation['data'][\Config\Database\DBConfig\Movie::$Title]}</u></a></strong> ({$reservation['data'][\Config\Database\DBConfig\Type::$Type]} , {if $reservation['data'][\Config\Database\DBConfig\Showing::$Dubbing] == 1}Dubbing{else}Napisy{/if}) Wersja językowa: {$reservation['data'][\Config\Database\DBConfig\LanguageVersion::$Version]}</h4>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-12 mt-sm-3 mt-sm-3 mt-md-0">
            <div class="text-center text-md-left">
                <button disabled class="btn btn-outline-primary m-1 mt-3 mt-md-1">{$reservation['data'][\Config\Database\DBConfig\Showing::$DateTime]|date_format:'%Y-%m-%d %H:%M'}</button>
            </div>
        </div>
    </div>
    <div class="row">
        <h5>Rezerwacje na seans</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Wybrane miejsca <span class="text-info text-right">Rząd/kolumna</span></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$reservation['reservationData'] item=$user key=$userK}
                <tr>
                    <td>{$user['userData']['firstName']}</td>
                    <td>{$user['userData']['lastName']}</td>
                    <td>{$user['userData']['email']}</td>
                    <td>{$user['userData']['mobilePhone']}</td>
                    <td>{foreach from=$user['reservations'] item=$res key=$resK}<button disabled class="btn-primary">{$res['row']}/{$res['column']}</button> {/foreach}</td>
                    <td><a href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Rezerwacje/Usun/{$userK}/" class="btn btn-danger">Usuń</a></td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
    <hr/>
    {/foreach}
    {/if}
</div>
{/block}