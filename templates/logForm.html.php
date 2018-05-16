{extends file="templates/globalTemplate.html.php"}
{block name="body"}


<div class = "col-lg-12 col-md-12">
        <form class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6" action="http://{$smarty.server.HTTP_HOST}{$subdir}Walidowanie/" method="POST">
            <legend class="text-center text-info">Zaloguj się</legend>
            <div class="form-group text-center">
                <label for="Login">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required="required"/>
            </div>
            <div class="form-group text-center">
                <label for="Password">Hasło</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Hasło" required="required"/>
            </div>
            <button type="submit" class="btn btn-success">Zaloguj</button>
        </form>
</div>
{if isset($error)}
<div>
    <h4 class="h4">{$error}</h4>
</div>
{/if}
{/block}