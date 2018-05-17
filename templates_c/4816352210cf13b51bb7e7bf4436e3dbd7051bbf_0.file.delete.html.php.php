<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:53:38
  from 'C:\xampp\htdocs\Projekty\ProjektZespolowy\cinema\templates\delete.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb56e2e885f5_06146352',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4816352210cf13b51bb7e7bf4436e3dbd7051bbf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekty\\ProjektZespolowy\\cinema\\templates\\delete.html.php',
      1 => 1526248564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb56e2e885f5_06146352 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Usuwanie elementu</h4>
            </div>
            <div class="modal-body">
                <p>Czy na pewno chcesz usunąć?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="deleteButton" class="btn btn-danger btn-ok">Tak</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Nie</button>
            </div>
        </div>
    </div>
</div><?php }
}
