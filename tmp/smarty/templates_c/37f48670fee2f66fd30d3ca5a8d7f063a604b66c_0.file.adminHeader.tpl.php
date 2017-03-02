<?php
/* Smarty version 3.1.30, created on 2017-02-14 22:15:09
  from "D:\OpenServer\domains\afanshop\views\admin\adminHeader.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a3573d336a95_12169603',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '37f48670fee2f66fd30d3ca5a8d7f063a604b66c' => 
    array (
      0 => 'D:\\OpenServer\\domains\\afanshop\\views\\admin\\adminHeader.tpl',
      1 => 1487099706,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:adminLeftcolumn.tpl' => 1,
  ),
),false)) {
function content_58a3573d336a95_12169603 (Smarty_Internal_Template $_smarty_tpl) {
?>

<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/main.css" type="text/css">
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery-1.7.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
js/admin.js"><?php echo '</script'; ?>
>
    </head>

    <body>
        <div id="header">
            <h1>Управление сайтом</h1>
        </div>
    <?php $_smarty_tpl->_subTemplateRender("file:adminLeftcolumn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div id="centerColumn">

<?php }
}
