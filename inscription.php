<?php

require_once("init.php");

$smarty->assign("title", "Inscription &amp; entraînement");
$smarty->assign("currentPage", "inscription");
$smarty->assign("userNamesByWave", $users->getUserNamesByWave());

require_once("finish.php");

?>