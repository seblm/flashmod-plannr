{if (isset($smarty.session.infoMessage))}<p style="color: green">{$smarty.session.infoMessage}</p>{/if}

<p>Si vous connaissez l'adresse email d'une personne invitée au repas de mariage et qui souhaite participer au flashmob,
vous pouvez l'inviter à participer en remplissant ce formulaire :</p>
<form method="post" action="user.php">
<input type="hidden" name="token" value="{$smarty.get.token}">
<span class="field">nom, prénom ou pseudo</span> <input type="text" name="name"><br>
<span class="field">email</span> <input type="text" name="email"><br>
<span class="field">lien avec les mariés</span> <input type="text" name="weddingLink"><br>
{if (isset($smarty.session.errorMessage))}<span class="field" style="color: red">{$smarty.session.errorMessage}</span><br>{/if}
<br>
<input type="submit" name="action" value="Inviter" class="css3button"/>
</form>

<p><strong>Note</strong> : vous ne pourrez évidemment pas inviter ni Laurent ni Camille à participer au flashmob :
<strong>c'est une surprise !</strong></p>