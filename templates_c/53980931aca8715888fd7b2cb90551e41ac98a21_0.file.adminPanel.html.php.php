<?php
/* Smarty version 3.1.32, created on 2018-05-16 00:10:59
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\adminPanel.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb5af3b4f2e8_78409646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53980931aca8715888fd7b2cb90551e41ac98a21' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\adminPanel.html.php',
      1 => 1526422257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb5af3b4f2e8_78409646 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12575743105afb5af3b483d4_28570868', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_12575743105afb5af3b483d4_28570868 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_12575743105afb5af3b483d4_28570868',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="container mb-5">
    <h1 class="h3 text-center">Zarządzanie</h1>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Zarządzanie/Seanse/"><img src="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
resources/images/adminPanel/Showings.png" class="img-fluid" alt="Repertuar"></a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Zarządzanie/Seanse/"><img src="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
resources/images/adminPanel/Movies.png" class="img-fluid" alt="Filmy"></a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Film/Dodaj" title="Dodaj Film" class="btn btn-outline-primary m-1 mt-3 mt-md-1">Add</a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-10">
            <a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Film/Edytuj/1" title="Edytuj Film" class="btn btn-outline-primary">Edytuj</a>
        </div>
    </div>
</div>
<?php
}
}
/* {/block "body"} */
}
