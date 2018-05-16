{extends file="templates/adminGlobalTemplate.html.php"}
{block name="content"}
<div class="container col-lg-12 col-md-12" xmlns:>
    <h1 class="h4 text-center text-info">Dodanie filmu</h1>
        <form class="container cent col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6" action="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/Dodawanie" id="formularz" method="post">
            <div class="form-group">
                <label for="Title">Tytuł filmu</label>
                <input type="text" class="form-control" name="Title" id="Title" placeholder="Podaj tytuł filmu" required="required"/>
            </div>
            <div class="form-group">
                <label for="ReleaseDate">Data Premiery</label>
                <input type="date" class="form-control" name="ReleaseDate" id="ReleaseDate"  placeholder="Podaj datę premiery" required="required"/>
            </div>
            <div class="form-group">
                <label for="Age">Podaj kryterium wieku</label>
                <input type="number" class="form-control" name="Age" id="Age" placeholder="Podaj kryterium wieku" required="required"/>
            </div>
            <div class="form-group">
                <label for="DurationTime">Czas trwania</label>
                <input type="number" class="form-control" name="DurationTime" id="DurationTime" placeholder="Czas trwania" required="required"/>
            </div>
            <div class="form-group">
                <label for="Genre">Gatunek:</label></br>
                <select id="Genre" name="Genre" required>
                {foreach from=$genres item=$genre}
                    <option value="{$genre[\Config\Database\DBConfig\Genre::$IdGenre]}">{$genre[\Config\Database\DBConfig\Genre::$GenreName]}</option>
                {/foreach}
                </select>
            </div>
            <div class="form-group">
                <label for="Production">Produkcja:</label></br>
                <select id="Production" name="Production" required>
                    {foreach from=$productions item=$production}
                    <option value="{$production[\Config\Database\DBConfig\Production::$IdProduction]}">{$production[\Config\Database\DBConfig\Production::$Country]}</option>
                    {/foreach}
                </select>
            </div>
            <div class="form-group">
                <label for="Description">Opis filmu</label>
                <textarea rows="4" cols="50" name="Description"  class="form-control" id="Description"required="required" placeholder="Podaj opis do filmu "></textarea>
            </div>
            <button type="submit" class="btn btn-success">Dodaj</button>
        </form>
    <hr/>
    <hr/>
</div>
{/block}