{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container mb-5">
    <h1 class="h3 text-center">Zarządzanie</h1>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <a href="http://{$smarty.server.HTTP_HOST}{$subdir}"><img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/adminPanel/Showings.png" class="img-fluid" alt="Repertuar"></a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <a href="http://{$smarty.server.HTTP_HOST}{$subdir}"><img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/adminPanel/Movies.png" class="img-fluid" alt="Filmy"></a>
    </div>
</div>
{/block}