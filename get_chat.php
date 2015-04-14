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
	exit;
	// $room=md5(mt_rand().mt_rand().mt_rand().mt_rand().mt_rand());
	// erase_log($room);
}

// echo 1;
$message=get_log($room);
$hash=abs(crc32($message));
if (isset($_GET['hash']) && $_GET['hash']==$hash)
{
	// echo strToHex(str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"ISO-8859-1")));
	// echo base64_encode(rc4Encrypt($room,base64_encode(str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"ISO-8859-1")))));
	// echo strToHex(rc4Encrypt($room,str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"ISO-8859-1"))));
	// echo str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"UTF-8"));
	// echo base64_encode(rc4Encrypt($room,base64_encode(str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"UTF-8")))));
	// $message=str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"ISO-8859-1"));
	// $message=str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"CP1552//IGNORE"));
	// $message=str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"UTF-8//IGNORE"));
	// $message=str_replace("\n",'<br/>',htmlentities(urldecode($message),ENT_QUOTES,"UTF-8"));
	// $message=base64_encode($message);
	// $message=strToHex($message);
	// $message=strToHex(rc4Encrypt($room,$message));
	// $message=strToHex(rc4Encrypt($room,'toto'));
	echo trim($message);
} else {
	echo $hash;
}

// echo 1;
?>