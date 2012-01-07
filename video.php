<?php

require_once("init.php");

$smarty->assign("title", "Vidéo");

$smarty->assign("currentPage", "video");

$smarty->assign("content", "
<p>Voici la chorégraphie <strong>entière</strong>. Pour participer au Flashmob, pensez à vous <a href=\"inscription.php?token=" . $_GET["token"] . "\">inscrire puis à vous entraîner</a> <strong>à partir de votre vague</strong>.</p>
<iframe width=\"640\" height=\"360\" src=\"http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0\" frameborder=\"0\" allowfullscreen></iframe>
");

$smarty->display("template.tpl");

?>