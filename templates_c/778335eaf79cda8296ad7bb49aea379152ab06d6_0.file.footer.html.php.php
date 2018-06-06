<?php
/* Smarty version 3.1.32, created on 2018-05-16 17:38:33
  from 'C:\xampp\htdocs\z gita\cinema\templates\footer.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afc50792312b9_54176321',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '778335eaf79cda8296ad7bb49aea379152ab06d6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\z gita\\cinema\\templates\\footer.html.php',
      1 => 1526248564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afc50792312b9_54176321 (Smarty_Internal_Template $_smarty_tpl) {
?>    <!-- Stopka -->
    <footer class="footer fixed-bottom bg-dark text-light text-center main-footer pt-3">
        <?php if (!isset($_SESSION['user'])) {?>
        <p>Projekt zespołowy - 2018</p>
        <?php } else { ?>
        <p>Panel administratora - 2018</p>
        <?php }?>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <?php echo '<script'; ?>
 src="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
resources/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
resources/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>

</html><?php }
}
