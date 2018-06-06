<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:51:23
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\navigation.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb565b06f4f7_46263815',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eac6db8dfa182955a7b9d0f465229c8eeacc8110' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\navigation.html.php',
      1 => 1526421030,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb565b06f4f7_46263815 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Nawigacja -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
">Kino</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($_SESSION['user'])) {?>


                <li <?php if (!isset($_SESSION['navigation']) || $_SESSION['navigation'] == "Movie") {?>class="nav-item active"<?php } else { ?>class="nav-item"<?php }?>>
                    <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Film">Repertuar
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li <?php if (isset($_SESSION['navigation']) && $_SESSION['navigation'] == "InComing") {?>class="nav-item active"<?php } else { ?>class="nav-item"<?php }?>>
                    <a class="nav-link" href="#">Wkrótce w kinie</a>
                </li>
                <li <?php if (isset($_SESSION['navigation']) && $_SESSION['navigation'] == "Pricing") {?>class="nav-item active"<?php } else { ?>class="nav-item"<?php }?>>
                    <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Cennik">Cennik</a>
                </li>
                <li <?php if (isset($_SESSION['navigation']) && $_SESSION['navigation'] == "Contact") {?>class="nav-item active"<?php } else { ?>class="nav-item"<?php }?>>
                    <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Kontakt">Kontakt</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
Wylogowanie/">Wyloguj się</a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav><?php }
}
