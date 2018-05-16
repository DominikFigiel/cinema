<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:45:17
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\globalTemplate.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb54ed0c2253_01289530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80999d8cc6cdc9dec1761dcbf4c5b145209dd6f9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\globalTemplate.html.php',
      1 => 1526248564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.html.php' => 1,
    'file:templates/navigation.html.php' => 1,
    'file:templates/footer.html.php' => 1,
  ),
),false)) {
function content_5afb54ed0c2253_01289530 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:templates/header.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:templates/navigation.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10566497245afb54ed0c1958_97144782', "body");
?>

<?php $_smarty_tpl->_subTemplateRender("file:templates/footer.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block "body"} */
class Block_10566497245afb54ed0c1958_97144782 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_10566497245afb54ed0c1958_97144782',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "body"} */
}
