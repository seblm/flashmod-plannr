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
{user->getWave assign="wave"}
<form method="post" action="user.php" id="waveForm">
<input type="hidden" name="token" value="{$smarty.get.token}"/>
<input type="hidden" name="wave" value="{$wave}" id="wave"/>
<input type="hidden" name="action" value="updateWave"/>
</form>
<div id="waves" style="width: 675px; height: 79px; background-image: url(images/wave{$wave}.png);" onmouseout="document.getElementById('waves').style.backgroundImage = 'url(images/wave{$wave}.png)';">
<a href="#" style="display: block; width: 120px; height: 79px; float: left;" title="vague 1"      onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave1.png)';" onclick="document.getElementById('wave').value = 1;    document.getElementById('waveForm').submit();"></a>
<a href="#" style="display: block; width: 112px; height: 79px; float: left;" title="vague 2"      onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave2.png)';" onclick="document.getElementById('wave').value = 2;    document.getElementById('waveForm').submit();"></a>
<a href="#" style="display: block; width: 112px; height: 79px; float: left;" title="vague 3"      onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave3.png)';" onclick="document.getElementById('wave').value = 3;    document.getElementById('waveForm').submit();"></a>
<a href="#" style="display: block; width: 112px; height: 79px; float: left;" title="vague 4"      onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave4.png)';" onclick="document.getElementById('wave').value = 4;    document.getElementById('waveForm').submit();"></a>
<a href="#" style="display: block; width: 117px; height: 79px; float: left;" title="vague 5"      onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave5.png)';" onclick="document.getElementById('wave').value = 5;    document.getElementById('waveForm').submit();"></a>
<a href="#" style="display: block; width: 102px; height: 79px; float: left;" title="aucune vague" onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave.png)'; " onclick="document.getElementById('wave').value = null; document.getElementById('waveForm').submit();"></a>
</div>
<div style="float: left; width: 115px; background-color: #363636; padding-left: 5px;">
0:04{foreach from=$userNamesByWave[1] item=name}<br>{$name}{/foreach}
</div>
<div style="float: left; width: 112px; background-color: #363636">
0:32{foreach from=$userNamesByWave[2] item=name}<br>{$name}{/foreach}
</div>
<div style="float: left; width: 112px; background-color: #363636">
1:01{foreach from=$userNamesByWave[3] item=name}<br>{$name}{/foreach}
</div>
<div style="float: left; width: 112px; background-color: #363636">
1:46{foreach from=$userNamesByWave[4] item=name}<br>{$name}{/foreach}
</div>
<div style="float: left; width: 117px; background-color: #363636">
2:35{foreach from=$userNamesByWave[5] item=name}<br>{$name}{/foreach}
</div>
<div style="float: left; width: 102px; background-color: #363636">
4:06{foreach from=$userNamesByWave[0] item=name}<br>{$name}{/foreach}
</div>
<p style="clear: both;">&nbsp;</p>
{if $wave !== null}
<p>Vous pouvez vous <strong>entraîner</strong> grâce à la vidéo ci-dessous : elle est automatiquement calée sur le début de votre vague :</p>
<iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0&start={
    if $wave == 1  }4{
elseif $wave == 2 }32{
elseif $wave == 3 }61{
elseif $wave == 4}106{
elseif $wave == 5}195{
/if}" frameborder="0" allowfullscreen></iframe>
{/if}