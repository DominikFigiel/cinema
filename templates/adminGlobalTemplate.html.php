{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div id="errorAndMessage">
{if isset($error)}
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    <strong id="error">{$error}</strong>
</div>
{/if}
{if isset($message)}
<div id="message" class="text-center alert alert-info" role="alert">
    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
    <span class="sr-only">Info:</span>
    <strong id="messageText">{$message}</strong>
</div>
{/if}
</div>
{block name="content"}{/block}
{include file="templates/delete.html.php"}
{/block}