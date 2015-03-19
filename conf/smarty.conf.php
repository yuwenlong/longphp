<?php
require_once DIR.'source/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->template_dir = DIR_TPL;
$smarty->compile_dir = DIR.'tpl_c/';
$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';
