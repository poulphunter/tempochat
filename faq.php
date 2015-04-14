<?php
require_once './config.php';
require_once './functions.php';
arg_vide();

if ($lang=='fr')
{
	include 'faq_fr.php';
} else {
	include 'faq_en.php';
}
// exit;

?>
