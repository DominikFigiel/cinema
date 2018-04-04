{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<h1 class="mt-5">Cennik</h1>
<h2>Bilety 2D</h2>
<table>
    <thead>
        <tr>
            <td></td>
            <td>Dni robocze</td>
            <td>Weekendy i święta</td>
        </tr>
    </thead>
    <tbody>
        {foreach $pricings2D as $pricing2D}
        <tr>
            <td>{$pricing2D[\Config\Database\DBConfig\PricingCategory::$PricingCategoryName]}</td>
        </tr>
        {/foreach}
    </tbody>
</table>
{/block}