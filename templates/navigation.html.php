<!-- Nawigacja -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="http://{$smarty.server.HTTP_HOST}{$subdir}">Kino</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                {if !isset($smarty.session.user)}


                <li {if !isset($smarty.session.navigation) || $smarty.session.navigation=="Movie"}class="nav-item active"{else}class="nav-item"{/if}>
                    <a class="nav-link" href="http://{$smarty.server.HTTP_HOST}{$subdir}Film">Repertuar
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li {if isset($smarty.session.navigation) && $smarty.session.navigation=="InComing"}class="nav-item active"{else}class="nav-item"{/if}>
                    <a class="nav-link" href="#">Wkrótce w kinie</a>
                </li>
                <li {if isset($smarty.session.navigation) && $smarty.session.navigation=="Pricing"}class="nav-item active"{else}class="nav-item"{/if}>
                    <a class="nav-link" href="http://{$smarty.server.HTTP_HOST}{$subdir}Cennik">Cennik</a>
                </li>
                <li {if isset($smarty.session.navigation) && $smarty.session.navigation=="Contact"}class="nav-item active"{else}class="nav-item"{/if}>
                    <a class="nav-link" href="http://{$smarty.server.HTTP_HOST}{$subdir}Kontakt">Kontakt</a>
                </li>
                {else}
                <li class="nav-item">
                    <a class="nav-link" href="http://{$smarty.server.HTTP_HOST}{$subdir}Wylogowanie/">Wyloguj się</a>
                </li>
                {/if}
            </ul>
        </div>
    </div>
</nav>