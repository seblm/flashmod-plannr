<?php require_once("init.php"); ?>
<!DOCTYPE html>
<html id="home" lang="fr">
<head>
<meta charset=utf-8 />
<meta name="viewport" content="width=620" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<title>Flashmob pour le mariage de Camille &amp; Laurent</title>
</head>
<body>
<section>
<div id="header" class="container">
<header id="logo"><h1><a href="http://fr.wikipedia.org/wiki/Flash_mob">Flashmob</a> mariage</h1></header>
</div>
<div id="menu">
 <ul>
  <li class="current_page_item"><a href="#">Présentation</a></li>
  <li><a href="repartition.php?token=<?php echo($_GET["token"]); ?>">Répartition</a></li>
  <li><a href="training.php?token=<?php echo($_GET["token"]); ?>">Entraînement</a></li>
 </ul>
</div>
<article>
<div id="splash"><img src="images/splash.jpg" width="800" height="250" alt="" /></div>
<div id="page">
 <div id="box1">
  <p>Cette page web doit absolument rester secrète : <strong>ne surtout pas la communiquer ni à Camille, ni à Laurent !</strong></p>
  <p>Le but est de vous permettre de vous entraîner sur la chorégraphie de <em>LMFAO - Party Rock Anthem (feat. Lauren
  Bennet &amp; GoonRock)</em>. Elle est extraite du jeu vidéo
  <a href="http://just-dance-thegame.ubi.com/just-dance-3/fr-fr/home/index.aspx">Just Dance 3</a> sur
  <a href="http://www.nintendo.fr/NOE/fr_FR/wii_54.html">Wii</a>.</p>
  <p>Le principe du <a href="http://fr.wikipedia.org/wiki/Flash_mob">Flashmob</a> est qu'il y ait de plus en plus de
  personnes qui se joignent à la chorégraphie. Ainsi si on commence à lancer la chanson et que une ou deux personnes
  commencent à danser sur la même chorégraphie, on pense simplement que ces personnes se sont un peu entraînées. Mais
  plus le temps passe et plus le nombre de danseurs synchronisés doit augmenter. Cela va créer un effet de surprise pour
  Camille &amp; Laurent et ils seront de plus en plus surpris de voir le nombre de danseurs grimper. Cette technique a
  aussi un autre avantage : permettre à ceux qui ne se sentent pas de danser la chorégraphie pendant toute sa durée (4:08
  quand même !)</p>
  <iframe width="640" height="360" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0" frameborder="0" allowfullscreen></iframe>
<!--
  <p></p>
  <iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0" frameborder="0" allowfullscreen></iframe>
  <p></p>
  <iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0&start=60" frameborder="0" allowfullscreen></iframe>
  <p></p>
  <iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0&start=120" frameborder="0" allowfullscreen></iframe>
  <p></p>
  <iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0&start=180" frameborder="0" allowfullscreen></iframe>
  <p></p>
  <iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0&start=240" frameborder="0" allowfullscreen></iframe>
-->
 </div>
</div>
</article>
<footer id="footer"><p>Contacter <a href="mailto:sebastian.lemerdy@gmail.com">Sébastian</a> pour toute question supplémentaire</p></footer>
</section>
</body>
</html>