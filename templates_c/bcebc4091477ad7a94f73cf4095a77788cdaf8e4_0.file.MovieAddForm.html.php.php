<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:54:51
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\MovieAddForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb572bf20fa7_89186941',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcebc4091477ad7a94f73cf4095a77788cdaf8e4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\MovieAddForm.html.php',
      1 => 1526419870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb572bf20fa7_89186941 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11638831145afb572bf1b555_27949131', "body");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_11638831145afb572bf1b555_27949131 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_11638831145afb572bf1b555_27949131',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">

        <form action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Movie&action=add" id="formularz" method="post">
            <legend class="text-center text-info">Dodaj Film Do Bazy</legend>


            <div class="form-group">
                <label for="Title">Tytuł Filmu</label>
                <input type="text" class="form-control" name="Title" id="Title" placeholder="Podaj Tytuł Filmu" required="required"/>
            </div>

            <div class="form-group">
                <label for="ReleaseDate">Data Premiery</label>
                <input type="date" class="form-control" name="ReleaseDate" id="ReleaseDate"  placeholder="Podaj Datę Premiery" required="required"/>
            </div>

            <div class="form-group">
                <label for="Age">Podaj Kryterium Wieku</label>
                <input type="text" class="form-control" name="Age" id="Age" placeholder="Podaj Hasło Do Serwisu" required="required"/>
            </div>

            <div class="form-group">
                <label for="DurationTime">Czas Trwania</label>
                <input type="text" class="form-control" name="DurationTime" id="DurationTime" placeholder="Podaj Czas Trwania Filmu" required="required"/>
            </div>

            <div class="form-group">
                <label for="Cover">Plakat</label>
                <input type="number" class="form-control" name="Cover" id="Cover" placeholder="Podaj Numer Okładki" required="required"/>
            </div>

            <div class="form-group">
                <label for="Description">Opis Filmu</label>
                <textarea name="Description"  class="form-control" id="Description"required="required">Podaj Opis Do Filmu </textarea>
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
