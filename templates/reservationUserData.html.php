{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="h2 mt-5">Podaj dane kontaktowe</span></h1>
        </div>
    </div>
    <div class="row">
        <div class="container col-lg-12 col-md-12" xmlns:">
            <form action="http://{$smarty.server.HTTP_HOST}{$subdir}Rezerwowanie/" method="post" class="container cent col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
                <input id="idShowing" name="idShowing" required value="{$idShowing}" readonly hidden/>
                <div class="form-group text-center">
                    <label>Imię: </label>
                    <input type="text" id="firstName" name="firstName" required minlength="5" maxlength="200" />
                </div>
                <div class="form-group text-center">
                    <label>Nazwisko: </label>
                    <input type="text" id="lastName" name="lastName" required minlength="5" maxlength="200" />
                </div>
                <div class="form-group text-center">
                    <label>Email: </label>
                    <input type="email" id="email" name="email" required minlength="5" maxlength="200" />
                </div>
                <div class="form-group text-center">
                    <label>Numer telefonu: </label>
                    <input type="number" id="mobilePhone" name="mobilePhone" required minlength="9" maxlength="12" />
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Zarezerwuj</button>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}