<?php

require_once("init.php");

$smarty->assign("title", "Présentation");
$smarty->assign("currentPage", "index");

$smarty->display("template.tpl");

?>