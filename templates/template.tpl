<!DOCTYPE html>
<html id="home" lang="fr">
<head>
<meta charset=utf-8 />
<meta name="viewport" content="width=620" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<title>Flashmob pour le mariage de Camille &amp; Laurent - {$title}</title>
<script type="text/javascript">{literal}

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6197811-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

{/literal}</script>
</head>
<body{if $currentPage != 'index'} class="body2"{/if}>
<div id="ribbon">
 <span>Confidentiel</span>
</div>
<section>
<div id="header" class="container">
<header id="logo"><h1><a href="http://fr.wikipedia.org/wiki/Flash_mob">Flashmob</a> mariage</h1></header>
</div>
<div id="menu">
<ul>
<li{if $currentPage == 'index'       } class="current_page_item"{/if}><a href="{if $currentPage == 'index'       }#{else}index.php?token={       $smarty.get.token}{/if}">Présentation</a></li>
<li{if $currentPage == 'video'       } class="current_page_item"{/if}><a href="{if $currentPage == 'video'       }#{else}video.php?token={       $smarty.get.token}{/if}">Vidéo</a></li>
<li{if $currentPage == 'inscription' } class="current_page_item"{/if}><a href="{if $currentPage == 'inscription' }#{else}inscription.php?token={ $smarty.get.token}{/if}">Inscription</a></li>
<li{if $currentPage == 'add-a-friend'} class="current_page_item"{/if}><a href="{if $currentPage == 'add-a-friend'}#{else}add-a-friend.php?token={$smarty.get.token}{/if}">Ajouter un ami</a></li>
</ul>
</div>
<article>
{if $currentPage == 'index' }<div id="splash"><img src="images/splash.jpg" width="800" height="250" alt="" /></div>{/if}
<div id="page">
<div id="box1">
{include file="$currentPage.tpl"}
</div>
</div>
</article>
<footer id="footer"><p>Contacter <a href="mailto:sebastian.lemerdy@gmail.com">Sébastian</a> pour toute question supplémentaire</p></footer>
</section>
</body>
</html>