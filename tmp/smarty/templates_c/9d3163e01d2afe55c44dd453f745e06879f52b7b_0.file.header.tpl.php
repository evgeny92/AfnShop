<?php
/* Smarty version 3.1.30, created on 2016-12-15 15:21:32
  from "D:\OpenServer\domains\afanshop\views\default\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58528acc130b22_79426579',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d3163e01d2afe55c44dd453f745e06879f52b7b' => 
    array (
      0 => 'D:\\OpenServer\\domains\\afanshop\\views\\default\\header.tpl',
      1 => 1481804490,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:leftcolumn.tpl' => 1,
  ),
),false)) {
function content_58528acc130b22_79426579 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
/css/main.css" type="text/css" />
    <?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery-1.7.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="/js/main.js"><?php echo '</script'; ?>
>
</head>
<body>

<div id="header">
    <h1>my shop - интернет магазин</h1>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:leftcolumn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>




<div id="centerColumn"><?php }
}
