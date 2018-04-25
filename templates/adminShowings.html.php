{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container">
    <h1 class="h4 text-center">Zarządzanie seansami</h1>
    <a class="btn btn-success" href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse/Dodaj">Dodaj seans</a>
    <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/{$i}" class="btn btn-primary mb-1">{('2018-04-28 20:17:59'|date_format:"%A")}</br>{('2018-04-28 20:17:59'|date_format:"%e %B")}</a>
</div>
{/block}