<?php

require_once("init.php");

$smarty->assign("title", "Ajouter un ami");
$smarty->assign("currentPage", "add-a-friend");

$smarty->display("template.tpl");

?>