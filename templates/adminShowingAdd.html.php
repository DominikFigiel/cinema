{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container">
    <h1 class="h4 text-center">Dodanie seansu</h1>
    <button {if isset($smarty.cookies.idSala) && $smarty.cookies.idSala == 1} class="btn btn-info active" {else} class="btn btn-info" {/if} onclick="setCookie('idSala', '1')">Sala 1</button>
    <button {if isset($smarty.cookies.idSala) && $smarty.cookies.idSala == 2} class="btn btn-info active" {else} class="btn btn-info" {/if} onclick="setCookie('idSala', '2')">Sala 2</button>
</div>
{/block}