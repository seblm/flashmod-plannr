<form method="post" action="user.php">
<input type="hidden" name="token" value="{$smarty.get.token}"/>
<span class="field">nom, prénom ou pseudo</span> <input type="text" name="name" value="{user->getName}"><br>
<span class="field">adresse email</span> <input type="text" value="{user->getEmail}" readonly="readonly"><br>
<span class="field">lien avec les mariés</span> <input type="text" name="weddingLink" value="{user->getWeddingLink}"><br>
{if (isset($smarty.session.errorMessage))}<span class="field" style="color: red">{$smarty.session.errorMessage}</span><br>{/if}
<input type="submit" name="action" value="Mettre à jour mes informations" class="css3button">
</form>
<p></p>
<p>Voici le <em>timing</em> de chaque vague : cliquez sur une vaque pour vous y inscrire.</p>
<form method="post" action="user.php" id="waveForm">
<input type="hidden" name="token" value="{$smarty.get.token}"/>
<input type="hidden" name="wave" value="{user->getWave}" id="wave"/>
<input type="hidden" name="action" value="updateWave"/>
</form>
<div id="waves" style="width: 573px; height: 79px; background-image: url(images/wave{user->getWave}.png);" onmouseout="document.getElementById('waves').style.backgroundImage = 'url(images/wave{user->getWave}.png)';">
 <a href="#" style="display: block; width: 120px; height: 79px; float: left;" onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave0.png)';" onclick="document.getElementById('wave').value = 0; document.getElementById('waveForm').submit();"></a>
 <a href="#" style="display: block; width: 112px; height: 79px; float: left;" onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave1.png)';" onclick="document.getElementById('wave').value = 1; document.getElementById('waveForm').submit();"></a>
 <a href="#" style="display: block; width: 112px; height: 79px; float: left;" onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave2.png)';" onclick="document.getElementById('wave').value = 2; document.getElementById('waveForm').submit();"></a>
 <a href="#" style="display: block; width: 112px; height: 79px; float: left;" onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave3.png)';" onclick="document.getElementById('wave').value = 3; document.getElementById('waveForm').submit();"></a>
 <a href="#" style="display: block; width: 117px; height: 79px; float: left;" onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave4.png)';" onclick="document.getElementById('wave').value = 4; document.getElementById('waveForm').submit();"></a>
</div>
<div style="float: left; width: 120px;">
&nbsp;{foreach from=$userNamesByWave[0] item=name}{$name}{if !$smarty.foreach.name.first}<br>{/if}{/foreach}
</div>
<div style="float: left; width: 112px;">
&nbsp;{foreach from=$userNamesByWave[1] item=name}{$name}{if !$smarty.foreach.name.first}<br>{/if}{/foreach}
</div>
<div style="float: left; width: 112px;">
&nbsp;{foreach from=$userNamesByWave[2] item=name}{$name}{if !$smarty.foreach.name.first}<br>{/if}{/foreach}
</div>
<div style="float: left; width: 112px;">
&nbsp;{foreach from=$userNamesByWave[3] item=name}{$name}{if !$smarty.foreach.name.first}<br>{/if}{/foreach}
</div>
<div style="float: left; width: 112px;">
&nbsp;{foreach from=$userNamesByWave[4] item=name}{$name}{if !$smarty.foreach.name.first}<br>{/if}{/foreach}
</div>
<p style="clear: both;">Vous pouvez vous <strong>entraîner</strong> en fonction de la vague que vous avez choisi.</p>
<iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0&start=28" frameborder="0" allowfullscreen></iframe></td>
<!--	
  <p>---&gt;-----&gt;-----&gt;</p>
  00:22 Party Rock<br>
  00:26 Yeah<br>
  00:30 Whoow<br>
  00:33 Let's go<br>
  <br>
  00:35 Party Rock is in The house tonight<br>
  00:38 Everybody just Have a good time<br>
  00:42 And we gon' make You loose yo mind<br>
  00:45 Everybody just Have a good time<br>
  00:49 Party rock is in The house tonight<br>
  00:52 Everybody just Have a good time<br>
  00:57 And we gon' make You loose yo mind<br>
  01:00 We just wanna See ya<br>
  01:03 Shake that<br>
  <br>
  01:18 In the club Party Rock<br>
  01:20 Lookin for ya girl? She on<br>
  01:22 Nonstop when We in the spot<br>
  01:23 Booty movin weight Like she own the block<br>
  01:25 Where the drank? I gots to know<br>
  01:27 Thight jeans tattoo Cuz I'm rock n' roll<br>
  01:29 Half white domino Gang of money<br>
  01:32 Oprah doe<br>
  <br>
  01:33 Yo<br>
  01:34 I'm runnin through these Like drano<br>
  01:36 I got that devilish flow Rock n' roll no halo<br>
  01:39 We Party Rock!<br>
  01:41 Yea that's the crew That I'm reppin<br>
  01:44 On a rise to the top No led in our Zepplin<br>
  01:47 Hey!<br>
  <br>
  01:48 Party Rock is in The house tonight<br>
  01:52 Everybody just Have a good time<br>
  01:55 And we gon' make You loose yo mind<br>
  01:59 Everybody just Have a good time<br>
  02:03 Party rock is in The house tonight<br>
  02:06 Everybody just Have a good time<br>
  02:10 And we gon' make You loose yo mind<br>
  02:14 We just wanna See ya<br>
  02:17 Shake that
-->