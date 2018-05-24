{extends file="templates/adminGlobalTemplate.html.php"}
{block name="content"}
<div class="container col-lg-12 col-md-12" xmlns:>
    <h1 class="h4 text-center text-info">Edycja filmu</h1>
    <form class="container cent col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6" action="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/Edytowanie/" method="post" enctype='multipart/form-data'>
        <input id="idMovie" name="idMovie" value="{$id}" hidden/>
        <div class="form-group">
            <label for="Title">Tytuł filmu</label>
            <input type="text" class="form-control" name="Title" id="Title" {if isset($title)}value="{$title}"{/if} placeholder="Podaj tytuł filmu" required="required"/>
        </div>
        <div class="form-group">
            <label for="ReleaseDate">Data Premiery</label>
            <input type="date" class="form-control" name="ReleaseDate" id="ReleaseDate" {if isset($releaseDate)}value="{$releaseDate}"{/if} placeholder="Podaj datę premiery" required="required"/>
        </div>
        <div class="form-group">
            <label for="Age">Podaj kryterium wieku</label>
            <input type="number" class="form-control" name="Age" id="Age" {if isset($age)}value="{$age}"{/if} placeholder="Podaj kryterium wieku" required="required"/>
        </div>
        <div class="form-group">
            <label for="DurationTime">Czas trwania</label>
            <input type="number" class="form-control" name="DurationTime" id="DurationTime" {if isset($durationTime)}value="{$durationTime}"{/if} placeholder="Czas trwania" required="required"/>
        </div>
        <div class="form-group">
            <label for="Genre">Wybierz gatunek:</label>
            <br>
            <select id="Genre" name="Genre[]" multiple required>
                {foreach from=$genres item=$genre}
                <option value="{$genre[\Config\Database\DBConfig\Genre::$IdGenre]}" {foreach from=$genresChecked item=$genreChecked}{if $genre[\Config\Database\DBConfig\Genre::$IdGenre] == $genreChecked[\Config\Database\DBConfig\Genre::$IdGenre]}selected{/if}{/foreach}>{$genre[\Config\Database\DBConfig\Genre::$GenreName]}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group">
            <label for="Production">Wybierz produkcje:</label>
            <br>
            <select id="Production" name="Production[]" multiple required>
                {foreach from=$productions item=$production}
                <option value="{$production[\Config\Database\DBConfig\Production::$IdProduction]}" {foreach from=$productionsChecked item=$productionChecked}{if $production[\Config\Database\DBConfig\Production::$IdProduction] == $productionChecked[\Config\Database\DBConfig\Production::$IdProduction]}selected{/if}{/foreach}>{$production[\Config\Database\DBConfig\Production::$Country]}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="CoverImg">Okładka</label>
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources\images\covers\{$id}.jpg" alt="Cover" name="CoverImg" class="form-control" id="CoverImg"required="required">
        </div>
        <div class="form-group">
            <label for="Cover">Inna okładka</label>
            <input type="file" name="Cover"  class="form-control" id="Cover" placeholder=".jpg .jpeg" accept="image/jpeg"/>
        </div>
        <div class="form-group">
            <label for="Description">Opis filmu</label>
            <textarea rows="4" cols="50" name="Description" class="form-control" id="Description"required="required" placeholder="Podaj opis do filmu ">{if isset($description)}{$description}{/if}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Edytuj</button>
        <a class="btn btn-danger" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/">Wróć</a>
    </form>
    <hr/>
    <hr/>
</div>
{/block}