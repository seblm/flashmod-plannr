<!DOCTYPE html>
<html id="home" lang="fr">
<head>
<meta charset=utf-8 />
<meta name="viewport" content="width=620" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<title>Site web à accès restrein</title>
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
<body class="body2">
<section>
<div id="header" class="container">
<header id="logo"><h1>Non authorisé</h1></header>
</div>
<article>
<div id="page">
<div id="box1">
 <p style="color: red;">Vous n'êtes pas autorisé à consulter ce site web.</p>
 {if (isset($smarty.session.infoMessage ))}<p style="color: green">{$smarty.session.infoMessage }</p>{
  else}
 <p>Si vous avez perdu le message contenant votre adresse personnalisée au site, vous pouvez vous la faire renvoyer en nous précisant votre adresse email.</p>
 {if (isset($smarty.session.errorMessage))}<p style="color: red"  >{$smarty.session.errorMessage}</p>{/if}
 <form method="post" action="forgot_url.php">
  <span class="field" style="color: lightgrey;">email</span> <input type="text" name="email"/><br><br>
  <input type="submit" value="Renvoyez-moi mon adresse personnalisée" class="css3button"/>
 </form>
 {/if}
</div>
</div>
</article>
<footer id="footer"><p>Contacter <a href="mailto:sebastian.lemerdy@gmail.com">Sébastian</a> pour toute question supplémentaire</p></footer>
</section>
</body>
</html>