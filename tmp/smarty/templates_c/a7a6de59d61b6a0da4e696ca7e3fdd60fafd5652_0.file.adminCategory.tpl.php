<?php
/* Smarty version 3.1.30, created on 2017-02-15 14:53:38
  from "D:\OpenServer\domains\afanshop\views\admin\adminCategory.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a44142104950_04894553',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7a6de59d61b6a0da4e696ca7e3fdd60fafd5652' => 
    array (
      0 => 'D:\\OpenServer\\domains\\afanshop\\views\\admin\\adminCategory.tpl',
      1 => 1487159614,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58a44142104950_04894553 (Smarty_Internal_Template $_smarty_tpl) {
?>
<h2>Категории</h2>
<table border="1" cellpadding="1" cellspacing="1">
    <tr>
        <th>№</th>
        <th>ID</th>
        <th>Название</th>
        <th>Родительская категория</th>
        <th>Действие</th>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item', false, NULL, 'categories', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_categories']->value['iteration']++;
?>
    <tr>
        <td><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_categories']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_categories']->value['iteration'] : null);?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
        <td><input type="edit" id="itemName_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"></td>
        <td>
            <select id="parentId_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                <option value="0">Главная категория
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsMainCategories']->value, 'mainItem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mainItem']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['mainItem']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['parent_id'] == $_smarty_tpl->tpl_vars['mainItem']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['mainItem']->value['name'];?>

                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>
        </td>
        <td><input type="button" value="Сохранить" onclick="updateCat(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
);"></td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table><?php }
}
