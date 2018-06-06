{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">

        <form action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Movie&action=update" id="formularz" method="post">
            <legend class="text-center text-info">Edytuj Film Z Bazy</legend>

            <div class="form-group">
                <input type="hidden" class="form-control" name="IdMovie" id="IdMovie" value="{$IdMovie}"/>
            </div>

            <div class="form-group">
                <label for="Title">Tytuł Filmu</label>
                <input type="text" class="form-control" name="Title" id="Title" placeholder="Podaj Tytuł Filmu" required="required" value="{$Title}"/>
            </div>

            <div class="form-group">
                <label for="ReleaseDate">Data Premiery</label>
                <input type="date" class="form-control" name="ReleaseDate" id="ReleaseDate"  placeholder="Podaj Datę Premiery" required="required" value="{$ReleaseDate}"/>
            </div>

            <div class="form-group">
                <label for="Age">Podaj Kryterium Wieku</label>
                <input type="text" class="form-control" name="Age" id="Age" placeholder="Podaj Hasło Do Serwisu" required="required" value="{$Age}"/>
            </div>

            <div class="form-group">
                <label for="DurationTime">Czas Trwania</label>
                <input type="text" class="form-control" name="DurationTime" id="DurationTime" placeholder="Podaj Czas Trwania Filmu" required="required" value="{$DurationTime}"/>
            </div>

            <div class="form-group">
                <label for="Cover">Plakat</label>
                <input type="number" class="form-control" name="Cover" id="Cover" placeholder="Podaj Numer Okładki" required="required" value="{$Cover}"/>
            </div>

            <div class="form-group">
                <label for="Description">Opis Filmu</label>
                <textarea name="Description"  class="form-control" id="Description"required="required">{$Description}</textarea>
            </div>


            <button type="submit" class="btn btn-success">Dodaj</button>
        </form>
    </div>
</div>

{/block}
