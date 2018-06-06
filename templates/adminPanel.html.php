{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="container mb-5">
    <h1 class="h3 text-center">Zarządzanie</h1>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Seanse/"><img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/adminPanel/Showings.png" class="img-fluid" alt="Repertuar"></a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Zarządzanie/Filmy/"><img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/adminPanel/Movies.png" class="img-fluid" alt="Filmy"></a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Dodaj" title="Dodaj Film" class="btn btn-outline-primary m-1 mt-3 mt-md-1">Add</a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-10">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Edytuj/1" title="Edytuj Film" class="btn btn-outline-primary">Edytuj</a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Dodaj" title="Dodaj Film" class="btn btn-outline-primary m-1 mt-3 mt-md-1">Add</a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-10">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Edytuj/1" title="Edytuj Film" class="btn btn-outline-primary">Edytuj</a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Dodaj" title="Dodaj Film" class="btn btn-outline-primary m-1 mt-3 mt-md-1">Add</a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-10">
            <a href="http://{$smarty.server.HTTP_HOST}{$subdir}Film/Edytuj/1" title="Edytuj Film" class="btn btn-outline-primary">Edytuj</a>
        </div>
    </div>
</div>
{/block}