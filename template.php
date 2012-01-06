<!DOCTYPE html>
<html id="home" lang="fr">
<head>
<meta charset=utf-8 />
<meta name="viewport" content="width=620" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<title>Flashmob pour le mariage de Camille &amp; Laurent - <?php echo(${title}); ?></title>
</head>
<body>
<section>
<div id="header" class="container">
<header id="logo"><h1><a href="http://fr.wikipedia.org/wiki/Flash_mob">Flashmob</a> mariage</h1></header>
</div>
<div id="menu">
<ul>
<li<?php if (${currentPage} == "index")        { ?> class="current_page_item"<?php } ?>><a href="<?php if (${currentPage} == "index")        { ?>#<?php } else { ?>index.php?token=<?php        echo($_GET["token"]); } ?>">Présentation</a></li>
<li<?php if (${currentPage} == "video")        { ?> class="current_page_item"<?php } ?>><a href="<?php if (${currentPage} == "video")        { ?>#<?php } else { ?>video.php?token=<?php        echo($_GET["token"]); } ?>">Vidéo</a></li>
<li<?php if (${currentPage} == "inscription")  { ?> class="current_page_item"<?php } ?>><a href="<?php if (${currentPage} == "inscription")  { ?>#<?php } else { ?>inscription.php?token=<?php  echo($_GET["token"]); } ?>">Inscription</a></li>
<li<?php if (${currentPage} == "add-a-friend") { ?> class="current_page_item"<?php } ?>><a href="<?php if (${currentPage} == "add-a-friend") { ?>#<?php } else { ?>add-a-friend.php?token=<?php echo($_GET["token"]); } ?>">Ajouter un ami</a></li>
</ul>
</div>
<article>
<?php if (${currentPage} == "index") { ?><div id="splash"><img src="images/splash.jpg" width="800" height="250" alt="" /></div><?php } ?>
<div id="page">
<div id="box1">
<?php echo(${content}) ?>
</div>
</div>
</article>
<footer id="footer"><p>Contacter <a href="mailto:sebastian.lemerdy@gmail.com">Sébastian</a> pour toute question supplémentaire</p></footer>
</section>
</body>
</html>