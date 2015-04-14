<?php
@session_start();

if (!(isset($_SESSION['login']) && isset($_SESSION['room'])))
{
	echo 'sec. error';
	// print_r($_SESSION);
	exit;
}

?>