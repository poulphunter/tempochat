<?php
session_start();
require_once './functions.php';
arg_vide();
require_once './secu_session.php';

if (isset($_SESSION['room']))
{
	$_GET['room']=$_SESSION['room'];
}

foreach($_POST as $key=>$val)
{
	$_GET[$key]=$val;
}

if (!isset($_GET['room']))
{
	exit;
}

if (isset($_GET['room']))
{
	$room=$_GET['room'];
} else {
	$room=md5(mt_rand().mt_rand().mt_rand().mt_rand().mt_rand());
	erase_log($room);
}

$message=((isset($_GET['msg']))?($_GET['msg']):(' '));
if ($message[strlen($message)-1]=="\n")
{
	$message=substr($message,0,-1);
}
$clef=$_GET['clef'];
if ($clef!=sha1('add chat test'.$room))
{
	echo 1;
	exit;
}
if (isset($_GET['reset']) && $_GET['reset']=='1')
{
	echo erase_log($room);
	exit;
}
// if (!isset($_SESSION['login']) && strlen($_SESSION['login'])<3)
// {
	// echo 'Login error';
	// exit;
// }

// $add_msg=urlencode(iconv("ISO-8859-1","UTF-8",''.($_SESSION['login']).' ('.date('H:i:s').') : '));
// $message=($jCryption->decrypt($message, $_SESSION["d"]["int"], $_SESSION["n"]["int"]));
// $message=(rc4Decrypt($room,hexToStr($message)));
// $message=iconv("CP1552","UTF-8",$message);
// $message=trim($message);
for ($i=0;$i<5;$i++)
{
	$lastc=$message[strlen($message)-1];
	if ($lastc=="\n" || $lastc=="\r")
	{
		$message=substr($message,0,-1);
	}
}
// $add_msg='';
erase_log($room);
echo write_log($room,$message);


?>