<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:53:38
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\adminGlobalTemplate.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb56e2e1f258_67135985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b082ccba25cd5ea8554c8e83422b23876dd193e2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\adminGlobalTemplate.html.php',
      1 => 1526248564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/delete.html.php' => 1,
  ),
),false)) {
function content_5afb56e2e1f258_67135985 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2069518715afb56e2e19e30_44563476', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "content"} */
class Block_17994070915afb56e2e1b9a2_86974761 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "content"} */
/* {block "body"} */
class Block_2069518715afb56e2e19e30_44563476 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_2069518715afb56e2e19e30_44563476',
  ),
  'content' => 
  array (
    0 => 'Block_17994070915afb56e2e1b9a2_86974761',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div id="errorAndMessage">
<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    <strong id="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</strong>
</div>
<?php }
if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
<div id="message" class="text-center alert alert-info" role="alert">
    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
    <span class="sr-only">Info:</span>
    <strong id="messageText"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</strong>
</div>
<?php }?>
</div>
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17994070915afb56e2e1b9a2_86974761', "content", $this->tplIndex);
?>

<?php $_smarty_tpl->_subTemplateRender("file:templates/delete.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "body"} */
}
