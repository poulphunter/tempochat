<?php

$url_base='http://'.$_SERVER['SERVER_NAME'].'/tempochat';
$lang_array=array('fr','en');
if (isset($_SESSION['lang']))
{
	$lang=$_SESSION['lang'];
} else {
	$lang='en';
}

if (isset($_GET['lang']) && in_array($_GET['lang'],$lang_array))
{
	$lang=$_GET['lang'];
	$_SESSION['lang']=$lang;
}

include_once './lng/'.$lang.'.php';
$temps_log_max=600; // 10 min
$nb_char_max=100000;
$log_rep='./logs/';
if (!file_exists($log_rep))
{
	mkdir($log_rep,0777);
}

?>