<?php

require_once("init.php");

$smarty->assign("title", "Ajouter un ami");

$smarty->assign("currentPage", "add-a-friend");

$smarty->assign("content", "
<p>Si vous connaissez l'adresse email d'une personne invitée au repas de mariage et qui souhaite participer au flashmob,
vous pouvez l'inviter à participer en remplissant ce formulaire :</p>
<span class=\"field\">nom, prénom ou pseudo</span> <input type=\"text\"><br>
<span class=\"field\">email</span> <input type=\"text\"><br>
<span class=\"field\">lien avec les mariés</span> <input type=\"text\"><br>
<span class=\"field\">&nbsp;</span> <input type=\"button\" value=\"Inviter\"></p>
<p><strong>Note</strong> : vous ne pourrez évidemment pas inviter ni Laurent ni Camille à participer au flashmob :
<strong>c'est une surprise !</strong></p>
");

$smarty->display("template.tpl");

?>