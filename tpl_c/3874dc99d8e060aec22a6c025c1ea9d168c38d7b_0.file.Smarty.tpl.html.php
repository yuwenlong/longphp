<?php
/* Smarty version 3.1.30, created on 2018-04-21 08:32:57
  from "/data/app/mycode/demo/longphp/tpl/Index/Smarty.tpl.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ada86b9b66753_89897563',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3874dc99d8e060aec22a6c025c1ea9d168c38d7b' => 
    array (
      0 => '/data/app/mycode/demo/longphp/tpl/Index/Smarty.tpl.html',
      1 => 1524270774,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:index/Header_smarty.tpl.html' => 1,
  ),
),false)) {
function content_5ada86b9b66753_89897563 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:index/Header_smarty.tpl.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo $_smarty_tpl->tpl_vars['title']->value;?>

<?php echo $_SESSION['name'];
}
}
