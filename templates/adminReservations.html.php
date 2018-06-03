{extends file="templates/adminGlobalTemplate.html.php"}
{block name="content"}
<div class="container mb-5">
    <h1 class="h4 text-center">Zarządzanie rezerwacjami</h1>
    <div class="row">
        <div class="col-lg-12 text-center">
            {if isset($reservation) && $reservation === true}
            <button class="active btn btn-outline-primary mb-1">Dodanie rezerwacji</button>
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Rezerwacje/Szukaj/" class="{if isset($reservation) && $reservation !== true}active{/if} btn btn-outline-primary mb-1">Szukanie rezerwacji</a>
            {else if isset($reservation) && $reservation !== true}
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Rezerwacje/" class="{if isset($reservation) && $reservation === true}active{/if} btn btn-outline-primary mb-1">Dodanie rezerwacji</a>
            <button class="active btn btn-outline-primary mb-1">Szukanie rezerwacji</button>
            {/if}
            <hr/>
        </div>
    </div>
    {block name="reservation"}{/block}
</div>
{/block}