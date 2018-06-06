<?php
/* Smarty version 3.1.32, created on 2018-05-16 17:22:05
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\MovieEditForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afc4c9dbf8e95_51632072',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95d54a9338c077bbaa217d537fbc5784e0e91c72' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\MovieEditForm.html.php',
      1 => 1526484122,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afc4c9dbf8e95_51632072 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8912905545afc4c9dbc1be5_30122638', "body");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_8912905545afc4c9dbc1be5_30122638 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_8912905545afc4c9dbc1be5_30122638',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">

        <form action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Movie&action=update" id="formularz" method="post">
            <legend class="text-center text-info">Edytuj Film Z Bazy</legend>

            <div class="form-group">
                <input type="hidden" class="form-control" name="IdMovie" id="IdMovie" value="<?php echo $_smarty_tpl->tpl_vars['IdMovie']->value;?>
"/>
            </div>

            <div class="form-group">
                <label for="Title">Tytuł Filmu</label>
                <input type="text" class="form-control" name="Title" id="Title" placeholder="Podaj Tytuł Filmu" required="required" value="<?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
"/>
            </div>

            <div class="form-group">
                <label for="ReleaseDate">Data Premiery</label>
                <input type="date" class="form-control" name="ReleaseDate" id="ReleaseDate"  placeholder="Podaj Datę Premiery" required="required" value="<?php echo $_smarty_tpl->tpl_vars['ReleaseDate']->value;?>
"/>
            </div>

            <div class="form-group">
                <label for="Age">Podaj Kryterium Wieku</label>
                <input type="text" class="form-control" name="Age" id="Age" placeholder="Podaj Hasło Do Serwisu" required="required" value="<?php echo $_smarty_tpl->tpl_vars['Age']->value;?>
"/>
            </div>

            <div class="form-group">
                <label for="DurationTime">Czas Trwania</label>
                <input type="text" class="form-control" name="DurationTime" id="DurationTime" placeholder="Podaj Czas Trwania Filmu" required="required" value="<?php echo $_smarty_tpl->tpl_vars['DurationTime']->value;?>
"/>
            </div>

            <div class="form-group">
                <label for="Cover">Plakat</label>
                <input type="number" class="form-control" name="Cover" id="Cover" placeholder="Podaj Numer Okładki" required="required" value="<?php echo $_smarty_tpl->tpl_vars['Cover']->value;?>
"/>
            </div>

            <div class="form-group">
                <label for="Description">Opis Filmu</label>
                <textarea name="Description"  class="form-control" id="Description"required="required"><?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
</textarea>
            </div>


            <button type="submit" class="btn btn-success">Dodaj</button>
        </form>
    </div>
</div>

<?php
}
}
/* {/block "body"} */
}
