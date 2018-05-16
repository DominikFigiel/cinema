<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:53:38
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\adminShowings.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb56e2cb9fc1_03271130',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79ed4a2e7d491b58acae1b355c78978486ef8087' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\adminShowings.html.php',
      1 => 1526248564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb56e2cb9fc1_03271130 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19672461305afb56e2c96c14_33627207', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/adminGlobalTemplate.html.php");
}
/* {block "content"} */
class Block_19672461305afb56e2c96c14_33627207 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_19672461305afb56e2c96c14_33627207',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<div class="container">
    <h1 class="h4 text-center">Zarządzanie seansami</h1>
    <a class="btn btn-success" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Zarządzanie/Seanse/Dodaj">Dodaj seans</a>
    <!-- Kalendarz -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <?php if (isset($_smarty_tpl->tpl_vars['calendar']->value)) {?>
            <p class="lead">Kalendarz</p>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['calendar']->value, 'day', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['day']->value) {
?>
            <?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%Y-%m-%d") == smarty_modifier_date_format($_smarty_tpl->tpl_vars['setDate']->value,"%Y-%m-%d")) {?>
            <button onclick="setCookie('dateAdminGetAll', <?php echo $_smarty_tpl->tpl_vars['i']->value;?>
)" class="btn btn-primary mb-1"><?php echo (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%e %B"));?>
</button>
            <?php } else { ?>
            <button onclick="setCookie('dateAdminGetAll', <?php echo $_smarty_tpl->tpl_vars['i']->value;?>
)" class="btn btn-secondary mb-1"><?php echo (smarty_modifier_date_format($_smarty_tpl->tpl_vars['day']->value,"%e %B"));?>
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
" onclick="setCookie('typeAdminGetAll', value)" <?php if ($_smarty_tpl->tpl_vars['type']->value[\Config\Database\DBConfig\Type::$Type] == $_smarty_tpl->tpl_vars['typeIn']->value) {?>class="btn btn-primary"<?php } else { ?>class="btn btn-outline-secondary"<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value[\Config\Database\DBConfig\Type::$Type];?>
</button>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            <button onclick="setCookie('typeAdminGetAll', 'All')" <?php if ('All' === $_smarty_tpl->tpl_vars['typeIn']->value) {?>class="btn btn-primary"<?php } else { ?>class="btn btn-outline-secondary"<?php }?>>Wszystkie</button>
            <hr/>
        </div>
    </div>

    <!-- Rodzaj sali -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="lead">Sala</p>
            <?php if (isset($_smarty_tpl->tpl_vars['cinemaHalls']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cinemaHalls']->value, 'cinemaHall');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cinemaHall']->value) {
?>
            <?php $_smarty_tpl->_assignInScope('tmp', $_smarty_tpl->tpl_vars['cinemaHall']->value[\Config\Database\DBConfig\CinemaHall::$Name]);?>
            <button value="<?php echo $_smarty_tpl->tpl_vars['cinemaHall']->value[\Config\Database\DBConfig\CinemaHall::$Name];?>
" onclick="setCookie('cinemaHallGetAll', value)" <?php if ($_smarty_tpl->tpl_vars['cinemaHall']->value[\Config\Database\DBConfig\CinemaHall::$Name] == $_smarty_tpl->tpl_vars['cinemaHallIn']->value) {?>class="btn btn-primary"<?php } else { ?>class="btn btn-outline-secondary"<?php }?>><?php echo $_smarty_tpl->tpl_vars['cinemaHall']->value[\Config\Database\DBConfig\CinemaHall::$Name];?>
</button>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            <button onclick="setCookie('cinemaHallGetAll', 'All')" <?php if ('All' === $_smarty_tpl->tpl_vars['cinemaHallIn']->value) {?>class="btn btn-primary"<?php } else { ?>class="btn btn-outline-secondary"<?php }?>>Wszystkie</button>
            <hr/>
        </div>
    </div>

    <!-- Filmy -->
    <div id="data">
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
    <div id="item" class="row">
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
                <div class="row">
                    <div class="btn btn-outline-info m-1 mt-3 mt-md-1 text-primary"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['hour']->value,'%H:%M');?>
</div>
                    <a class="btn btn-outline-info m-1 mt-3 mt-md-1 text-info" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Zarządzanie/Seanse/Edytuj/<?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Showing::$IdShowing];?>
">Edytuj</a>
                    <a class="btn btn-outline-danger m-1 mt-3 mt-md-1 text-danger" data-toggle="modal" data-href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Zarządzanie/Seanse/" value="<?php echo $_smarty_tpl->tpl_vars['movie']->value[\Config\Database\DBConfig\Showing::$IdShowing];?>
" data-target="#modal_delete">Usuń</a>
                </div>
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
    </div>
</div>
<?php
}
}
/* {/block "content"} */
}
