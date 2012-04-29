{if (isset($smarty.session.infoMessage))}<p style="color: green">{$smarty.session.infoMessage}</p>{/if}

<section>
  <div class="page-header"><h1>Inviter un ami</h1></div>
  <p>Si vous connaissez l'adresse email d'une personne invitée à la soirée du mariage et qui pourrait vouloir participer au flashmob, vous pouvez l'inviter en remplissant ce formulaire</p>
</section>

<form method="post" action="user.php" class="form-horizontal">
  <input type="hidden" name="token" value="{$smarty.get.token}">
  <input type="hidden" name="action" value="invite">
  <div class="control-group">
    <label class="control-label" for="name">nom, prénom ou pseudo</label>
    <div class="controls"><input type="text" name="name" id="name"></div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">email</label>
    <div class="controls"><input type="text" name="email" id="email"></div>
  </div>
  <div class="control-group">
    <label class="control-label" for="weddingLink">lien avec les mariés</label>
    <div class="controls">
      <input type="text" name="weddingLink" id="weddingLink">
      <p class="help-block">Exemple : témoin du marié ou grand oncle de la mariée</p>
    </div>
    {if (isset($smarty.session.errorMessage))}<div style="color: red">{$smarty.session.errorMessage}</div>{/if}
  </div>
  <div class=form-actions>
    <button type="submit" class="btn btn-primary">Inviter</button>
  </div>
</form>

<p><strong>Note</strong> : vous ne pourrez évidemment pas inviter ni Laurent ni Camille à participer au flashmob :
<strong>c'est une surprise !</strong></p>