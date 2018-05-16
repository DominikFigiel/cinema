<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:52:57
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\LogForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb56b94b2422_76854142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8145d1bf9f5f6981aade347bc0678242cee18f1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\LogForm.html.php',
      1 => 1526419220,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb56b94b2422_76854142 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15576186615afb56b94aa8d2_67948196', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_15576186615afb56b94aa8d2_67948196 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_15576186615afb56b94aa8d2_67948196',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<div class = "col-lg-12 col-md-12">
        <form class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6" action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Walidowanie/" method="POST">
            <legend class="text-center text-info">Zaloguj się</legend>
            <div class="form-group text-center">
                <label for="Login">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required="required"/>
            </div>
            <div class="form-group text-center">
                <label for="Password">Hasło</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Hasło" required="required"/>
            </div>
            <button type="submit" class="btn btn-success">Zaloguj</button>
        </form>
</div>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
<div>
    <h4 class="h4"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
</div>
<?php }
}
}
/* {/block "body"} */
}
