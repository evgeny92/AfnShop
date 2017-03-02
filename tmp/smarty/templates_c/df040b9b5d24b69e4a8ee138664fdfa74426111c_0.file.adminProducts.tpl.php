<?php
/* Smarty version 3.1.30, created on 2017-02-21 13:42:38
  from "D:\OpenServer\domains\afanshop\views\admin\adminProducts.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58ac199e6e9203_41490517',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df040b9b5d24b69e4a8ee138664fdfa74426111c' => 
    array (
      0 => 'D:\\OpenServer\\domains\\afanshop\\views\\admin\\adminProducts.tpl',
      1 => 1487668828,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58ac199e6e9203_41490517 (Smarty_Internal_Template $_smarty_tpl) {
?>
<h2>Товар</h2>
<input type="button" onclick="createXML();" value="Сохранить в XML">
<div id="xml-place"></div>
<table border="1" cellpadding="1" cellspacing="1">
    <caption>Добавить продукт</caption>
    <tr>
        <th>Название</th>
        <th>Цена</th>
        <th>Категория</th>
        <th>Описание</th>
        <th>Сохранить</th>
    </tr>

    <tr>
        <td><input type="edit" id="newItemName" value=""></td>
        <td><input type="edit" id="newItemPrice" value=""></td>
        <td>
            <select id="newItemCatId">
                <option value="0">Главная категория
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'itemCat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['itemCat']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemCat']->value['name'];?>

                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>
        </td>
        <td><textarea id="newItemDesc"></textarea></td>
        <td><input type="button" value="Сохранить" onclick="addProduct();"></td>

    </tr>
</table><br>

<table border="1" cellspacing="1" cellpadding="1"><br>
    <caption>Редактировать</caption>
        <tr>
            <th>№</th>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Категория</th>
            <th>Описание</th>
            <th>Удалить</th>
            <th>Изображение</th>
            <th>Сохранить</th>
        </tr>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']++;
?>
    <tr>
        <td><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] : null);?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['itemp']->value['id'];?>
</td>
        <td><input type="edit" id="itemName_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" size="17" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"></td>
        <td><input type="edit" id="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" size="8" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
"></td>
        <td>
            <select id="itemCatId<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                <option value="0">Главная категория
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'itemCat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['itemCat']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['itemCat']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['category_id'] == $_smarty_tpl->tpl_vars['itemCat']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['itemCat']->value['name'];?>

                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>
        </td>
        <td>
            <textarea id="itemDesc_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                <?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>

            </textarea>
        </td>
        <td><input type="checkbox" id="itemStatus_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['status'] == 0) {?>checked="checked"<?php }?>></td>
        <td>
            <?php if ($_smarty_tpl->tpl_vars['item']->value['image']) {?>
                <img src="/images/products/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" width="100" alt="">
            <?php }?>
            <form action="/admin/upload/" method="post" enctype="multipart/form-data">
                <input type="file" name="filename"><br>
                <input type="hidden" name="itemId" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                <input type="submit" value="Загрузить"><br>
            </form>
        </td>
        <td><input type="button" value="Сохранить" onclick="updateProduct('<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
')"></td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>




















<?php }
}
