<!DOCTYPE html>
<html id="home" lang="fr">
<head>
<meta charset=utf-8 />
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<title>Flashmob pour le mariage de Camille &amp; Laurent - {$title}</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
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
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="index.php?token={$smarty.get.token}">Flashmob mariage</a>
      <ul class="nav">
        <li{if $currentPage == 'index'} class="active"{/if}><a href="{if $currentPage == 'index'}#{else}index.php?token={$smarty.get.token}{/if}">Présentation</a></li>
        <li class="divider-vertical"></li>
        <li class="dropdown{if $currentPage == 'video' || $currentPage == 'inscription'} active{/if}">
          <a href="#" class="dropdown-toggle{if $currentPage == 'video' || $currentPage == 'inscription'} active{/if}" data-toggle="dropdown">Vidéo <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li{if $currentPage == 'video'} class="active"{/if}><a href="{if $currentPage == 'video'}#{else}video.php?token={$smarty.get.token}{/if}">Entrainement</a></li>
            <li{if $currentPage == 'inscription'} class="active"{/if}><a href="{if $currentPage == 'inscription' }#{else}inscription.php?token={$smarty.get.token}{/if}">Inscription</a></li>
          </ul>
        </li>
        <li class="divider-vertical"></li>
        <li{if $currentPage == 'add-a-friend'} class="active"{/if}><a href="{if $currentPage == 'add-a-friend'}#{else}add-a-friend.php?token={$smarty.get.token}{/if}">Ajouter un ami</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container">
  <div id="ribbon"><span>Confidentiel</span></div>
{include file="$currentPage.tpl"}
  <footer class="footer"><p>Contacter <a href="mailto:sebastian.lemerdy@gmail.com">Sébastian</a> pour toute question supplémentaire</p></footer>
</div>
</body>
</html>