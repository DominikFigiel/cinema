{extends file="templates/globalTemplate.html.php"}
{block name="body"}

<!-- Treść strony -->
<div class="container mb-5">
    <div class="row">

        <div class="col-lg-12">
            <img src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/images/contact_cinema.jpg" class="img-fluid" alt="Responsive image">
        </div>


        <div class="col-lg-12">
            <h1 class="mt-5">Kontakt</h1>
            <hr/>

            <p>
                <b>Siedziba</b></br>
                Kino (nazwa robocza)</br>
                ul. Poznańska 201-205</br>
                62-800 Kalisz</br>
            </p>

            <p>
                <b>Sekretariat</b></br>
                telefon: +48 62 594 43 21, +48 62 521 58 93</br>
                e-mail: kino@pwsz-kalisz.edu.pl</br>
            </p>
        </div>
    </div>
</div>

{/block}