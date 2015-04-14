<?php
require_once './config.php';
require_once './functions.php';
arg_vide();



?>
	<div class="container vertical-center">
	<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
		<table style="width:100%">
			<tr>
				<td><img src="./img/cat.png" alt="cat" /></td>
				<td><span style="font-size:40px;"><?php echo $lng['product'];?></span></td>
			</tr>
		</table>
		<br/>
				<div class="col-xs-4">
					<?php echo $lng['Room']; ?>&nbsp;: 
				</div>
				<div class="col-xs-6">
					<span style="font-size:smaller ;"><input class="form-control" id="clef1" style="background-color:#E0E0FF;" type="text" value="" onkeyup="if ((event.keyCode==13) && !(event.shiftKey)) window.location.href='<?php echo $url_base.'?';?>'+this.value; return false;"/></span>
				</div>
				<div class="col-xs-2">
				<input class="btn btn-default" type="button" value="Go" onclick="window.location.href='<?php echo $url_base.'?';?>'+$('#clef1').val();" />
				</div>
			<br>
			<br>
				<div class="col-xs-4">
					<?php echo $lng['Random Room']; ?>&nbsp;:
				</div>
				<div class="col-xs-6">
					<span style="font-size:smaller ;"><input class="form-control" id="clef" style="background-color:#E0E0FF;" type="text" value="<?php echo md5(mt_rand().mt_rand().mt_rand().mt_rand().mt_rand()); ?>" onkeyup="if ((event.keyCode==13) && !(event.shiftKey)) window.location.href='<?php echo $url_base.'?';?>'+this.value; return false;"/></span>
				</div>
				<div class="col-xs-2">
					<input class="btn btn-default" type="button" value="Go" onclick="window.location.href='<?php echo $url_base.'?';?>'+$('#clef').val();" />
				</div>
			<br>
			<br>
				<div class="col-xs-4">
					<?php echo $lng['Direct Link']; ?>&nbsp;:
				</div>
				<div class="col-xs-8">
					<span style="font-size:smaller ;"><input class="form-control" readonly="readonly" style="background-color:#E0E0FF;font-size:8px;" type="text" value="<?php echo $url_base.'?'.$room; ?>"/></span>
				</div>
	</div>
	</div>
	
	<div class="container">
		<div style="font-size:14px;">
			<p style="margin-bottom: 0cm;">Envie d'un Chat gratuit, simple,anonyme et non censurable ?</p>
            <p style="margin-bottom: 0cm;">Pour lancer le Chat, rien de plus simple : entrez un nom de salle, un pseudo vous sera attribué automatiquement et vous pourrez commencer à chatter.</p>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Pas besoin de créer de compte</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Pas de mot de passe</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Accès rapide</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Salle crée automatiquement</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Pas de censure</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Anonyme</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Information
de nouveau message</p>
              </li>
            </ul>
		</div>
			
		<div style="font-size:14px;">
				<p style="margin-bottom: 0cm;"><b>Fonctionnement :</b></p>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Vous pouvez utiliser n’importe quel nom de salle pour vous connecter instantanément au Chat.<br/>
Absolument rien ne vous sera demandé pour y accéder.</p>
              </li>
            </ul>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Vous pouvez accéder facilement à n’importe quelle salle en tapant :<br/>
                <a href="<?php echo $url_base; ?>?nom-de-la-salle"><?php echo $url_base; ?>?nom-de-la-salle</a></p>
              </li>
            </ul>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Aucun mot de passe ne vous est demandé, aussi le nom de la salle sert de clef d’accès.</p>
              </li>
            </ul>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Les messages du Chat sont automatiquement effacés après 10 minutes d’inactivité.</p>
              </li>
            </ul>
		</div>
	</div>