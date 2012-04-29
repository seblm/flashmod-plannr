{user->getWave assign='wave'}<section>
  <div class="page-header"><h1>Voici la video de la chorégraphie</h1></div>
  <iframe width="560" height="315" src="http://www.youtube.com/embed/b4kXbdK9O3Y?rel=0&start={
      if $wave == 1  }4{
  elseif $wave == 2 }32{
  elseif $wave == 3 }61{
  elseif $wave == 4}106{
  elseif $wave == 5}195{
  else               }0{
  /if}" frameborder="0" allowfullscreen></iframe>
</section>

<section>
  {if $wave == 0}<div class="alert alert-error">
    <div class="row">
      <div class="span12">
        <h4 class="alert-heading">Pas encore inscrit dans une vague !</h4>
      </div>
    </div>
    <div class="row">
      <div class="span8">Vous devez aller sur le menu <strong>Inscription</strong> pour choisir à quel moment vous rejoignez le flashmob.</div>
      <div class="span3"><a class="btn btn-primary" href="inscription.php?token={$smarty.get.token}">Inscription</a></div>
    </div>
  </div>{else}<div class="alert alert-info">
    <h4 class="alert-heading">Cool !</h4>
    <p>Vous êtes inscrits dans la vague n°{$wave}. Elle commence à {
      if $wave == 1              }4 secondes{
  elseif $wave == 2             }32 secondes{
  elseif $wave == 3  }1 minute et 1 seconde{
  elseif $wave == 4 }1 minute et 46 secondes{
  elseif $wave == 5}3 minutes et 15 secondes{
  else                           }0 seconde{
      /if} du début.</p>
    <p>Si vous souhaitez changer de vague, vous devez retourner dans le menu Inscription. Cliquez alors sur la vague désirée et valider à nouveau.</p>
  </div>{/if}
</section>

<section>
  <div class="page-header">
    <h1>Les paroles</h1>
  </div>
<p>
  00:22 Party Rock<br>
  00:26 Yeah<br>
  00:30 Whoow<br>
  00:33 Let's go
</p><p>
  00:35 Party Rock is in The house tonight<br>
  00:38 Everybody just Have a good time<br>
  00:42 And we gon' make You loose yo mind<br>
  00:45 Everybody just Have a good time<br>
  00:49 Party rock is in The house tonight<br>
  00:52 Everybody just Have a good time<br>
  00:57 And we gon' make You loose yo mind<br>
  01:00 We just wanna See ya<br>
  01:03 Shake that
</p><p>
  01:18 In the club Party Rock<br>
  01:20 Lookin for ya girl? She on<br>
  01:22 Nonstop when We in the spot<br>
  01:23 Booty movin weight Like she own the block<br>
  01:25 Where the drank? I gots to know<br>
  01:27 Thight jeans tattoo Cuz I'm rock n' roll<br>
  01:29 Half white domino Gang of money<br>
  01:32 Oprah doe
</p><p>
  01:33 Yo<br>
  01:34 I'm runnin through these Like drano<br>
  01:36 I got that devilish flow Rock n' roll no halo<br>
  01:39 We Party Rock!<br>
  01:41 Yea that's the crew That I'm reppin<br>
  01:44 On a rise to the top No led in our Zepplin<br>
  01:47 Hey!
</p><p>
  01:48 Party Rock is in The house tonight<br>
  01:52 Everybody just Have a good time<br>
  01:55 And we gon' make You loose yo mind<br>
  01:59 Everybody just Have a good time<br>
  02:03 Party rock is in The house tonight<br>
  02:06 Everybody just Have a good time<br>
  02:10 And we gon' make You loose yo mind<br>
  02:14 We just wanna See ya<br>
  02:17 Shake that<br>
  02:19 Everyday I'm suffling
</p><p>
  02:35 Step up fast And be the first<br>
  02:38 Girl to make me Throw this<br>
  02:39 We gettin money Don't be mad<br>
  02:41 Now stop hatin this bad<br>
  02:43 One mo shot for us Anoter round<br>
  02:44 Please fill up my cup Don't mess around<br>
  02:46 We just wanna see Ya shake it now<br>
  02:48 Now you home with me Get up get down<br>
  02:52 Put yo hands up To the sound<br>
  02:54 Get up get down<br>
  02:56 Put yo hands up To the sound<br>
  02:58 Get up get down<br>
  03:00 Put yo hands up To the sound<br>
  03:01 Put yo hands up To the sound<br>
  03:03 Put yo hands up To the sound<br>
  03:05 Get up Get up<br>
  03:07 Get up Get up<br>
  03:09 Get up Get up<br>
  03:10 Get up Get up<br>
  03:11 Get up<br>
  03:13 Put yo hands up To the sound<br>
  03:15 To the sound<br>
  03:16 Put yo hands up Put yo hands up<br>
  03:18 Put yo hands up Put yo hands up
</p><p>
  03:20 Party Rock is in The house tonight<br>
  03:24 Everybody just Have a good time<br>
  03:28 And we gon' make You loose yo mind<br>
  03:31 Everybody just Have a good good good time<br>
  03:36 Ooh oh oh oh<br>
  03:40 Ooh oh oh oh<br>
  03:44 Ooh oh oh oh<br>
  03:47 Ooh oh oh oh
</p><p>
  03:50 Shake that<br>
  03:51 Everyday I'm suffling<br>
  03:56 Put your put your<br>
  03:59 Put your put your<br>
  04:03 Put your put your
</p>
</section>