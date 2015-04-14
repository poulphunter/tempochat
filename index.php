<?php
session_start();

if (isset($_GET['reset']))
{
	session_destroy();
	session_start();
}

require_once './functions.php';
arg_vide();

if (isset($_GET['exp']) && $_GET['exp']=='1')
{
	$_SESSION['exp']=1;
}

if (!isset($_SESSION['login']))
{
	$_SESSION['login']=get_login();
}
$_SESSION['login']=get_login();

if (isset($_GET['room']) || isset($_SESSION['room']))
{
	if (isset($_GET['room']))
	{
		$room=$_GET['room'];
		$_SESSION['room']=$room;
	}
	if (isset($_SESSION['room']))
		$room=$_SESSION['room'];
} else {
	$room='';
	erase_log($room);
	$_SESSION['room']=$room;
	if (!isset($_GET['page']))
{
	if ($lang=='fr')
	{
		$_GET['page']='accueil_fr';
	} else {
		$_GET['page']='accueil_en';
	}
	}
}



if (isset($_GET['clean']))
{
	clean_logs();
}

$message=get_log($room);
if (!isset($_SESSION['lang']))
{
	$_SESSION['lang']=((strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2))=='fr')?('fr'):('en'));
}
// $lien_web='?'.$room.'&amp;reset=1&amp;clean=1';
$lien_web='?&amp;reset=1&amp;clean=1&amp;lang='.$_SESSION['lang'];
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<title><?php echo $lng['title']; ?></title>
<META NAME="Language" CONTENT="<?php echo $_SESSION['lang']; ?>">
<META NAME="Robots" CONTENT="All">
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/png" href="favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 
	CSS 
-->
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/bootstrap-theme.min.css" rel="stylesheet">
<link href="./css/jquery-ui.min.css" rel="stylesheet">
<!-- 
	JS 
-->
<script src="./js/jquery-1.11.2.min.js"></script>
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/gibberish-aes-1.0.0.min.js"></script>
<script src="./js/notify.js"></script>


<style>
	body
	{
		font-family: arial,sans-serif;
		// font-size: small;
		color: #333;
	}
	
	.navbar
	{
		margin: 1px;
	}

	.navbar-default
	{
		background-image: linear-gradient(to bottom, #eef 0px, #aaf 100%);
		background-repeat: repeat-x;
		border-radius: 4px;
		box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 5px rgba(0, 0, 0, 0.075);
	}
	
	.navbar-nav > li > a
	{
		color: #444 !important;
	}
	
	
	.text1
	{
		color: #aaf;
	}
	
	.text1 a
	{
		color: #aaf;
	}
	
	.vertical-center
	{
	  min-height: 88%;  /* Fallback for browsers do NOT support vh unit */
	  min-height: 88vh; /* These two lines are counted as one :-)       */
	  display: flex;
	  align-items: center;
	}
	
	.vertical-center2
	{
	  min-height: 150px;  /* Fallback for browsers do NOT support vh unit */
	  min-height: 46vh; /* These two lines are counted as one :-)       */
	}

.flexbox-parent
{
    width: 100%;
    height: 100%;

    display: flex;
    flex-direction: column;
    
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
            
    background: rgba(255, 255, 255, .1);
}

.flexbox-item
{
    padding: 8px;
}
.flexbox-item-grow
{
    flex: 1; /* same as flex: 1 1 auto; */
}

.flexbox-item.header
{
    background: rgba(255, 0, 0, .1);
}
.flexbox-item.footer
{
    background: rgba(0, 255, 0, .1);
}
.flexbox-item.content
{
    background: rgba(0, 0, 255, .1);
}

.fill-area
{
    display: flex;
    flex-direction: row;
    
    justify-content: flex-start; /* align items in Main Axis */
    align-items: stretch; /* align items in Cross Axis */
    align-content: stretch; /* Extra space in Cross Axis */
    
}
.fill-area-content
{
    background: rgba(0, 0, 0, .3);
    border: 1px solid #000000;
    
    /* Needed for when the area gets squished too far and there is content that can't be displayed */
    overflow: auto; 
}


</style>

</head>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span><img src="./img/cat_32.png" alt="chat" /></span>&nbsp;&nbsp;<span><input id="clefql" style="background-color:#E0E0FF;width:100px;" type="text" value="<?php echo $room; ?>" onkeyup="if ((event.keyCode==13) && !(event.shiftKey)) window.location.href='<?php echo $url_base; ?>?'+this.value; return false;"/><input type="button" value="Go" onclick="window.location.href='<?php echo $url_base; ?>?'+$('#clefql').val();" /></span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $lien_web;?>"><?php echo $lng['name']; ?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="#" onclick="switch_notif();" ><span id="notif_img" class="glyphicon glyphicon-comment" aria-hidden="true" style="color:red;"></span></a></li>
        <li><a href="#" onclick="switch_sound();" ><span id="sound_img" class="glyphicon glyphicon-volume-off" aria-hidden="true"  style="color:red;"></span></a></li>
        <li><a href="#" ><?php echo write_lang(); ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id="users-contain" class="ui-widget" style="width:100%;height:100%;">
		<table class="ui-widget ui-widget-content" style="width:100%;height:100%;">
		<tbody>
			<th colspan="2" class="text1">
				<center><font size="3px"><a href="<?php echo $lien_web;?>"><?php echo $lng['Home']; ?></a> - <a href="?<?php echo md5(mt_rand().mt_rand().mt_rand().mt_rand().mt_rand());?>"><?php echo $lng['Random Room']; ?></a> - <a href="?page=faq"><?php echo $lng['F.A.Q.']; ?></a> - <a href="?page=contact"><?php echo $lng['Contact']; ?></a></font></center>
			</th>
		</tr>
		</tbody>
		</table>
		
<?php
	if (isset($_GET['page']))
	{
		include $_GET['page'].'.php';
	} else {
		include 'salle.php';
	}
?>
</div>



</body></html>
