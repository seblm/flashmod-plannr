<?php

require_once("init.php");

$smarty->assign("title", "Vidéo");
$smarty->assign("currentPage", "video");

$smarty->display("template.tpl");

?>