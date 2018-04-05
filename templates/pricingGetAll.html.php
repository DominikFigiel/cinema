{extends file="templates/globalTemplate.html.php"}
{block name="body"}

<!-- Treść strony -->
<div class="container mb-5">

    <!-- Naglowek -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Cennik</h1>
            <hr/>
        </div>
    </div>

    <!-- Seans - Typ 2D -->
    <div class="row">
        <div class="col-lg-12 text-center mt-2">
            <h2>Bilety 2D</h2>
        </div>
    </div>
    <div class="row">
        <!-- Tabela 2D - Start -->
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <td></td>
                {foreach $pricings2DWorkingDays as $pricing2D}
                <td>{$pricing2D[\Config\Database\DBConfig\PricingCategory::$PricingCategoryName]}</td>
                {/foreach}
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Dni robocze</td>
                {foreach $pricings2DWorkingDays as $pricing2D}
                <td>{$pricing2D[\Config\Database\DBConfig\Pricing::$Price]}</td>
                {/foreach}
            </tr>
            <tr>
                <td>Weekendy i święta</td>
                {foreach $pricings2DWeekends as $pricing2D}
                <td>{$pricing2D[\Config\Database\DBConfig\Pricing::$Price]}</td>
                {/foreach}
            </tr>
            </tbody>
        </table>
        <!-- Tabela 2D - Koniec -->
    </div>


    <!-- Seans - Typ 3D -->
    <div class="row">
        <div class="col-lg-12 text-center  mt-2">
            <h2>Bilety 3D</h2>
        </div>
    </div>
    <div class="row">
        <!-- Tabela 3D - Start -->
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <td></td>
                {foreach $pricings3DWorkingDays as $pricing3D}
                <td>{$pricing3D[\Config\Database\DBConfig\PricingCategory::$PricingCategoryName]}</td>
                {/foreach}
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Dni robocze</td>
                {foreach $pricings3DWorkingDays as $pricing3D}
                <td>{$pricing3D[\Config\Database\DBConfig\Pricing::$Price]}</td>
                {/foreach}
            </tr>
            <tr>
                <td>Weekendy i święta</td>
                {foreach $pricings3DWeekends as $pricing3D}
                <td>{$pricing3D[\Config\Database\DBConfig\Pricing::$Price]}</td>
                {/foreach}
            </tr>
            </tbody>
        </table>
        <!-- Tabela 3D - Koniec -->
    </div>

</div>

{/block}