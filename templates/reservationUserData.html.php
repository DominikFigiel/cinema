{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="h2 mt-5">Dane kontaktowe</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="container col-lg-12 col-md-12" xmlns:">
            <form action="http://{$smarty.server.HTTP_HOST}{$subdir}Rezerwowanie/" method="post" class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
                <input id="idShowing" name="idShowing" required value="{$idShowing}" readonly hidden/>
                <div class="form-group text-center">
                    <input class="form-control" size="20" type="text" id="firstName" name="firstName" placeholder="Imię" title="Imię" required minlength="3" maxlength="200" />
                </div>
                <div class="form-group text-center">
                    <input class="form-control" placeholder="Nazwisko" title="Nazwisko" type="text" id="lastName" name="lastName" required minlength="3" maxlength="200" />
                </div>
                <div class="form-group text-center">
                    <input class="form-control" placeholder="Email" title="Emial" type="email" id="email" name="email" required minlength="5" maxlength="200" />
                </div>
                <div class="form-group text-center">
                    <input class="form-control" type="number" placeholder="Numer telefonu" title="Numer telefonu" id="mobilePhone" name="mobilePhone" required minlength="9" maxlength="12" />
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Zarezerwuj</button>
                    <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Rezerwacja/Miejsce/Seans/{$idShowing}" class="btn btn-danger">Wróć</a>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}