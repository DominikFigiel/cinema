<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:52:56
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\showingGetAll.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb56b8893db9_19649713',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b068c1450941979d15cf9ee9d9533955110db29' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\showingGetAll.html.php',
      1 => 1526421172,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb56b8893db9_19649713 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2612208815afb56b8874a18_42979051', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_2612208815afb56b8874a18_42979051 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_2612208815afb56b8874a18_42979051',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<!-- Treść strony -->
<div class="container mb-5">

    <!-- Kalendarz -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Repertuar</h1>
            <?php if (isset($_smarty_tpl->tpl_vars['calendar']->value)) {?>
            <p class="lead">Kalendarz</p>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['calendar']->value, 'day', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['day']->value) {
?>
            <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%Y-%m-%d") == smarty_modifier_date_format($_smarty_tpl->tpl_vars['setDate']->value,"%Y-%m-%d")) {?>
            <button  onclick="setCookie('dateGetAll', <?php echo $_smarty_tpl->tpl_vars['i']->value;?>
)" class="btn btn-primary mb-1"><?php echo (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%A"));?>
</br><?php echo (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%e %B"));?>
</button>
            <?php } else { ?>
            <button  onclick="setCookie('dateGetAll', <?php echo $_smarty_tpl->tpl_vars['i']->value;?>
)" class="btn btn-secondary mb-1"><?php echo (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%A"));?>
</br><?php echo (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%e %B"));?>
</button>
            <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            <hr/>
        </div>
    </div>
    <!-- Rodzaj seansu -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="lead">Rodzaj seansu</p>
            <?php if (isset($_smarty_tpl->tpl_vars['types']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['types']->value, 'type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['type']->value) {
?>
            <?php $_smarty_tpl->_assignInScope('tmp', $_smarty_tpl->tpl_vars['type']->value[\Config\Database\DBConfig\Type::$Type]);?>
            <button value="<?php echo $_smarty_tpl->tpl_vars['type']->value[\Config\Database\DBConfig\Type::$Type];?>
" onclick="setCookie('typeGetAll', value)" <?php if ($_smarty_tpl->tpl_vars['type']->value[\Config\Database\DBConfig\Type::$Type] == $_smarty_tpl->tpl_vars['typeIn']->value) {?>class="btn btn-primary"<?php } else { ?>class="btn btn-outline-secondary"<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value[\Config\Database\DBConfig\Type::$Type];?>
</button>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            <button onclick="setCookie('typeGetAll', 'All')" <?php if ('All' === $_smarty_tpl->tpl_vars['typeIn']->value) {?>class="btn btn-primary"<?php } else { ?>class="btn btn-outline-secondary"<?php }?>>Wszystkie</button>
            <hr/>
        </div>
    </div>

    <!-- Filmy -->
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['showings']->value, 'types');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['types']->value) {
?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['types']->value, 'dubbings');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dubbings']->value) {
?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dubbings']->value, 'movie');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['movie']->value) {
?>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
            <img src="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
resources/images/covers/<?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Movie::$Cover];?>
.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-lg-6 col-md-5 col-sm-6 col-6">
            <p><strong><a class="text-dark" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Film/Szczegóły/<?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Movie::$IdMovie];?>
"><u><?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Movie::$Title];?>
</u></a></strong> (<?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Type::$Type];?>
 , <?php if ($_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Showing::$Dubbing] == 1) {?>Dubbing<?php } else { ?>Napisy<?php }?>) Wersja językowa: <?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\LanguageVersion::$Version];?>
</p>
            <p>Od lat: <?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Movie::$Age];?>
</p>
            <p>Czas trwania: <?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Movie::$DurationTime];?>
</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-sm-3 mt-sm-3 mt-md-0">
            <div class="text-center text-md-left">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['movie']->value['hours'], 'hour');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['hour']->value) {
?>
                <a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Rezerwacja/Miejsce/Seans/<?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Showing::$IdShowing];?>
" title="Zarezerwuj bilet" class="btn btn-outline-primary m-1 mt-3 mt-md-1"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['hour']->value,'%H:%M');?>
</a>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
    </div>
    <hr/>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <!-- Pamiętać usunąć -->
    <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
    <div>
        <h4 class="h4"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
    </div>
    <?php }?>
    <a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Film/Dodaj" title="Zarezerwuj bilet" class="btn btn-outline-primary m-1 mt-3 mt-md-1">Add</a>

</div>
<?php
}
}
/* {/block "body"} */
}
