<?php
/* Smarty version 3.1.30, created on 2017-02-14 17:54:06
  from "D:\OpenServer\domains\afanshop\views\admin\admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a31a0ed00393_63023521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd8ca4d6f13d780d3c5f2a85cb42cdfc007b9fb8' => 
    array (
      0 => 'D:\\OpenServer\\domains\\afanshop\\views\\admin\\admin.tpl',
      1 => 1487084036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58a31a0ed00393_63023521 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="blockNewCategory">
    Новая категория:
    <input type="text" name="newCategoryName" id="newCategoryName" value=""><br>

    Является подкатегорией для
    <select name="generalCatId">
        <option value="0">Главная категория
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </select><br>
    <input type="button" onclick="newCategory();" value="Добавить категорию">
</div><?php }
}
