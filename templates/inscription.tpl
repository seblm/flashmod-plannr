<section>
  <div class="page-header"><h1>Choix d'une vague</h1></div>
  <p>Cette page permet à chaque personne de s'inscrire pour rejoindre le flashmob au moment qu'il souhaite.</p>
  <p>
    Éric et moi serons les seuls participants de la première vague.<br>
    Vous pouvez nous rejoindre à partir de la vague 2 ou plus tard suivant ce que vous souhaitez.
  </p>
</section>
<div class="row">&nbsp;</div>
<section>
  <div class="page-header"><h1>Mon compte</h1></div>
  <form method="post" action="user.php" class="form-horizontal">
    <input type="hidden" name="token" value="{$smarty.get.token}"/>
    <input type="hidden" name="action" value="update"/>
    <div class="control-group">
      <label class="control-label" for="name">nom, prénom ou pseudo</label>
      <div class="controls"><input type="text" name="name" value="{user->getName}" id="name"></div>
    </div>
    <div class="control-group">
      <label class="control-label" for="email">adresse email</label>
      <div class="controls"><input type="text" value="{user->getEmail}" readonly="readonly"></div>
    </div>
    <div class="control-group">
      <label class="control-label" for="weddingLink">lien avec les mariés</label>
      <div class="controls">
        <input type="text" name="weddingLink" value="{user->getWeddingLink}">
        <p class="help-block">Exemple : témoin du marié ou grand oncle de la mariée</p>
      </div>
    </div>
    {if (isset($smarty.session.errorMessage))}<span class="field" style="color: red">{$smarty.session.errorMessage}</span><br>{/if}
    <p>La chorégraphie comprend 5 vagues. Vous pouvez les visualiser ci-dessous.<br>
    Cliquer sur la vague choisie puis valider votre inscription.</p>
    {user->getWave assign="wave"}
    <input type="hidden" name="wave" value="{$wave}" id="wave"/>
    <div id="waves" style="width: 675px; height: 79px; background-image: url(images/wave{$wave}.png);" onmouseout="document.getElementById('waves').style.backgroundImage = 'url(images/wave' + document.getElementById('wave').value + '.png)';">
      <a style="{if in_array(1, $availableWaves) || $wave == 1}cursor: pointer; {/if}display: block; width: 120px; height: 79px; float: left;" title="vague 1" {if in_array(1, $availableWaves) || $wave == 1} onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave1.png)';" onclick="document.getElementById('wave').value = 1;"{/if}></a>
      <a style="{if in_array(2, $availableWaves) || $wave == 2}cursor: pointer; {/if}display: block; width: 112px; height: 79px; float: left;" title="vague 2" {if in_array(2, $availableWaves) || $wave == 2} onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave2.png)';" onclick="document.getElementById('wave').value = 2;"{/if}></a>
      <a style="{if in_array(3, $availableWaves) || $wave == 3}cursor: pointer; {/if}display: block; width: 112px; height: 79px; float: left;" title="vague 3" {if in_array(3, $availableWaves) || $wave == 3} onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave3.png)';" onclick="document.getElementById('wave').value = 3;"{/if}></a>
      <a style="{if in_array(4, $availableWaves) || $wave == 4}cursor: pointer; {/if}display: block; width: 112px; height: 79px; float: left;" title="vague 4" {if in_array(4, $availableWaves) || $wave == 4} onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave4.png)';" onclick="document.getElementById('wave').value = 4;"{/if}></a>
      <a style="{if in_array(5, $availableWaves) || $wave == 5}cursor: pointer; {/if}display: block; width: 117px; height: 79px; float: left;" title="vague 5" {if in_array(5, $availableWaves) || $wave == 5} onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave5.png)';" onclick="document.getElementById('wave').value = 5;"{/if}></a>
      <a style="                                               cursor: pointer;      display: block; width: 102px; height: 79px; float: left;" title="aucune vague"                                            onmouseover="document.getElementById('waves').style.backgroundImage = 'url(images/wave.png)'; " onclick="document.getElementById('wave').value = null;"  ></a>
    </div>
    <div style="float: left; width: 115px; background-color: #363636; padding-left: 5px;">
      <span class="wave">vague 1<br>0:04</span>{foreach from=$userNamesByWave item=userNames name=userNames}{if $smarty.foreach.userNames.index == 1                                        }{foreach from=$userNames item=name}<br>{$name}{/foreach}{/if}{/foreach}
    </div>
    <div style="float: left; width: 112px; background-color: #363636">
      <span class="wave">vague 2<br>0:32</span>{foreach from=$userNamesByWave item=userNames name=userNames}{if $smarty.foreach.userNames.index >= 1 && $smarty.foreach.userNames.index <= 2}{foreach from=$userNames item=name}<br>{$name}{/foreach}{/if}{/foreach}
    </div>
    <div style="float: left; width: 112px; background-color: #363636">
      <span class="wave">vague 3<br>1:01</span>{foreach from=$userNamesByWave item=userNames name=userNames}{if $smarty.foreach.userNames.index >= 1 && $smarty.foreach.userNames.index <= 3}{foreach from=$userNames item=name}<br>{$name}{/foreach}{/if}{/foreach}
    </div>
    <div style="float: left; width: 112px; background-color: #363636">
      <span class="wave">vague 4<br>1:46</span>{foreach from=$userNamesByWave item=userNames name=userNames}{if $smarty.foreach.userNames.index >= 1 && $smarty.foreach.userNames.index <= 4}{foreach from=$userNames item=name}<br>{$name}{/foreach}{/if}{/foreach}
    </div>
    <div style="float: left; width: 117px; background-color: #363636">
      <span class="wave">vague 5<br>2:35</span>{foreach from=$userNamesByWave item=userNames name=userNames}{if $smarty.foreach.userNames.index >= 1 && $smarty.foreach.userNames.index <= 5}{foreach from=$userNames item=name}<br>{$name}{/foreach}{/if}{/foreach}
    </div>
    <div style="float: left; width: 102px; background-color: #363636">
      <span class="wave">non inscrits<br>4:06</span>{foreach from=$userNamesByWave item=userNames name=userNames}{if $smarty.foreach.userNames.index == 0                                        }{foreach from=$userNames item=name}<br>{$name}{/foreach}{/if}{/foreach}
    </div>
    <p style="clear: both;">&nbsp;</p>
    <div class=form-actions>
      <button type="submit" class="btn btn-primary">Valider mon inscription</button>
    </div>
  </form>
</section>