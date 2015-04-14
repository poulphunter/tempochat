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
			<p style="margin-bottom: 0cm;">Need a quick, simple, free, easy Chat
who protect your privacy and who can't be filtered ?</p>
            <p style="margin-bottom: 0cm;">To start conversation, no more easy : enter a room name and start chatting.</p>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">No registration</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">No password</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Quick access</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Room automatically created</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">No censorship</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">Anonymous</p>
              </li>
              <li>
                <p style="margin-bottom: 0cm;">New message arrival information</p>
              </li>
            </ul>
			</div>
		<div style="font-size:14px;">
            <p style="margin-bottom: 0cm;"><b>How does it work ?
:</b></p>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Chose the room name you want and instantly go into.<br/>
Nothing will be asked for access.</p>
              </li>
            </ul>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Easily access the chat room you want with 'welcome' page or with url like :
				<a href="<?php echo $url_base; ?>?room-name"><?php echo $url_base; ?>?room-name</a>
				</p>
              </li>
            </ul>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">No password. Hence, chose an unique room name as 'complicated-name01234'.</p>
              </li>
            </ul>
            <ul>
              <li>
                <p style="margin-bottom: 0cm;">Chat messages are automatically erased after 10 minutes of inactivity on the room.</p>
              </li>
            </ul>
			</div>
	</div>