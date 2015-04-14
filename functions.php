<?php

require_once './config.php';
require_once './prenoms.php';

function arg_vide()
{
	$count=0;
	foreach ($_GET as $key=>$val)
	{
		if ($val=='')
		{
			$count+=1;
			$room=$key;
		}
	}
	if ($count==1 && $room!='')
	{
		$_GET['room']=$room;
	}
}

function get_login()
{
	global $prenoms;
	return filtre_nom_fichier($prenoms[rand(0,count($prenoms))-1].'_'.rand(0,999));
}

function filtre_nom_fichier($in)
{
	$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_]@');
	$replace = array ('e','a','i','u','o','c','_','');
	return preg_replace($search, $replace, $in);
}

function random_buff($len)
{
	$buff='';
	for ($i=0;$i<$len;$i++)
	{
		$buff.=chr(mt_rand(0,255));
	}
}

function sel_room($room,$var=0)
{
	if ($var==0)
	{
		return addslashes(sha1('Zi)(5gR$ME4X!INd6[hU9AfG&3KDCiBscWiO}(;")M&uN=IS;r'.$room.'3apI:\'p4yHCI+A)\'g@cyP)X~c<)#JTyeM6M<ih$lZCkhtPN"^D').md5('i>I-5LC.WeEZB"<lekap<y\nwPnXL0NC]l|}+Xgtre yg&[]"\\'.$room.'8|,E~db)&~TC D%N<P$X9Ir9IWdNUw--r-<!WFg0!k6c|I_lU8').sha1(':|nS[%B6zaP_yf$Tl{fo6lK/]nv3Z_Z]v(pdkvri0*hX{2P#|J'.sha1('[nZsSS1eAYLSjyUE.l,7>~B|=/L9$bwzP>H8nekM@hWN*nRqYT'.$room).'+L~ueA{Diev`iL\'7.zV%0Kn|,%H=I \'(Ff=O+_aOw__dn+G{?\'b'));
	} else {
		return addslashes(sha1('i>I-5LC.WeEZB"<lekap<y\nwPnXL0NC]l|}+Xgtre yg&[]"\\'.$room.'Zi)(5gR$ME4X!INd6[hU9AfG&3KDCiBscWiO}(;")M&uN=IS;r').md5('3apI:\'p4yHCI+A)\'g@cyP)X~c<)#JTyeM6M<ih$lZCkhtPN"^D'.$room.':|nS[%B6zaP_yf$Tl{fo6lK/]nv3Z_Z]v(pdkvri0*hX{2P#|J').sha1('8|,E~db)&~TC D%N<P$X9Ir9IWdNUw--r-<!WFg0!k6c|I_lU8'.sha1('+L~ueA{Diev`iL\'7.zV%0Kn|,%H=I \'(Ff=O+_aOw__dn+G{?\'b'.$room).'[nZsSS1eAYLSjyUE.l,7>~B|=/L9$bwzP>H8nekM@hWN*nRqYT'));
	}
}

function nom_fichier($name)
{
	return sha1('J_SdHP*vfPA>jmHKdOgM-*Xry4]Ska0jNaJZkuN!LL$d?CrRD53RI%F&R@~dB;Gk`]K0JvQl0z%m^?.Cs-L\'Q.Hxe^HD-AWrt{R('.$name.'zIqZCSZ^3l}a^J/.INIJu~n)]tBMrz]UW8!G9a1U#4dcky>RS58\y ph^hC2a:9??Kp2,a$lT!x^ypByg-;C`z*C-Z$r`:D`^Ra&').md5('[fi0>-wAR*3NPn>ua5-/_Aa gKF#g!h%[?Ab0lT~Y$ROjTh56a'.$name.'*K{PGCgM WC:oB1~%*1-[^Aw)"DrV>viKr0JJoxlXVR8^JB19z').abs(crc32($name.'i(n7k7pPm%Bdmd|9tF".I\'|T@@ua@*72S{YYro_B1!fU9\^YYC')).'.txt';
}

function clean_logs()
{
	global $log_rep;
	global $temps_log_max;
	if (isset($_GET['temps_max']))
		$temps_log_max=intval($_GET['temps_max']);
	$dir=opendir($log_rep);
	while ($f=readdir($dir))
	{
	   if($f!='.' && $f!='..' && is_file($log_rep.$f) && abs(time()-filemtime($log_rep.$f))>$temps_log_max)
	   {
			// echo $log_rep.$f.'<br/>';
			erase_file($log_rep.$f);
	   }
	}
	closedir($dir);
}

function check_log($name)
{
	global $log_rep;
	global $temps_log_max;
	$fname=$log_rep.nom_fichier($name);
	if (file_exists($fname))
	{
		if (abs(time()-filemtime($fname))>$temps_log_max)
		{
			erase_file($fname);
		}
	}
}

function erase_file($fname)
{
	if (file_exists($fname))
	{
		$len=strlen(file_get_contents($fname));
		file_put_contents($fname,random_buff($len));
		unlink($fname);
	} else {
		// echo 'file error : '.$fname."\n";
	}
	return 0;
}

function log_ip($name,$reset=0)
{
	date_default_timezone_set('Europe/Paris');
	global $log_rep;
	$fnameip=$log_rep.nom_fichier($name).'ip.txt';
	$tabip=array();
	if (file_exists($fnameip))
	{
		$tabip=unserialize(file_get_contents($fnameip));
	}
	if ($reset==1)
	{
		$tabip=array();
	}
	$tabip[((isset($_SESSION['login']))?('['.$_SESSION['login'].'] '):('')).getRealIpAddr()]=date('H:i:s');
	file_put_contents($fnameip,serialize($tabip));
}

function log_ip_aff($name)
{
	date_default_timezone_set('Europe/Paris');
	global $log_rep;
	$fnameip=$log_rep.nom_fichier($name).'ip.txt';
	$tabip=array();
	if (file_exists($fnameip))
	{
		$tabip=unserialize(file_get_contents($fnameip));
	}
	$tabip[((isset($_SESSION['login']))?('['.$_SESSION['login'].'] '):('')).getRealIpAddr()]=date('H:i:s');
	$iplist='';
	foreach ($tabip as $login=>$time)
	{
		$iplist.=$login.'   '.$time."<br>";
	}
	return $iplist;
}


function erase_log($name)
{
	global $log_rep;
	$fname=$log_rep.nom_fichier($name);
	log_ip($name,1);
	if (file_exists($fname))
	{
		$len=strlen(file_get_contents($fname));
		file_put_contents($fname,random_buff($len));
		unlink($fname);
	} else {
		// echo 'file error : '.$fname."\n";
	}
	return 0;
}

function get_log($name)
{
	check_log($name);
	global $log_rep;
	$fname=$log_rep.nom_fichier($name);
	touch($fname);
	log_ip($name);
	if (file_exists($fname))
	{
		$log=file_get_contents($fname);
		// file_put_contents($fname,$log);
		return $log;
	} else {
		file_put_contents($fname,'');
	}
	return '';
}

function write_log($name,$message)
{
	check_log($name);
	log_ip($name);
	global $log_rep;
	global $nb_char_max;
	$fname=$log_rep.nom_fichier($name);
	if (file_exists($fname))
	{
		// $log=$message."\n".file_get_contents($fname);
		$log=$message;
		if (strlen($log)>$nb_char_max)
		{
			erase_file($fname);
			return 1;
			// $log=substr($log,0,$nb_char_max);
		}
		file_put_contents($fname,$log);
	} else {
		if (strlen($message)>$nb_char_max)
		{
			return 1;
		}
		file_put_contents($fname,$message);
	}
	return 0;
}

function hexToStr($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2)
    {
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

function strToHex($string)
{
    $hex='';
    for ($i=0; $i < strlen($string); $i++)
    {
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}

/*
function write_lang()
{
	$lng='';
	global $url_base;
	global $room;
	global $lang_array;
	$url='?';
	foreach ($_GET as $key=>$val)
	{
		if ($key=='lang' || $key=='' || $key=='room')
			continue;
		$url.=$key.'='.$val.'&amp;';
	}
	foreach ($lang_array as $lang)
	{
		$lng.='&nbsp;<a href="'.$url_base.'/'.$url.'lang='.$lang.'"><img border="0" src="./img/lang_'.$lang.'.gif" alt="'.$lang.'" /></a>';
	}
	return $lng;
}
*/

function write_lang()
{
	$lng='';
	global $url_base;
	global $room;
	global $lang_array;
	$url='?';
	foreach ($_GET as $key=>$val)
	{
		if ($key=='lang' || $key=='' || $key=='room')
			continue;
		$url.=$key.'='.$val.'&amp;';
	}
	foreach ($lang_array as $lang)
	{
		// 
		$lng.='&nbsp;<img border="0" onclick="document.location=\''.$url_base.'/'.$url.'lang='.$lang.'\';" src="./img/lang_'.$lang.'.gif" alt="'.$lang.'" />';
	}
	return $lng;
}

function isTorRequest()
{
	$reverse_client_ip = implode('.', array_reverse(explode('.', $_SERVER['REMOTE_ADDR'])));
	$reverse_server_ip = implode('.', array_reverse(explode('.', $_SERVER['SERVER_ADDR'])));
	$hostname = $reverse_client_ip . "." . $_SERVER['SERVER_PORT'] . "." . $reverse_server_ip . ".ip-port.exitlist.torproject.org";
	return gethostbyname($hostname) == "127.0.0.2";

}

function getRealIpAddr()
{
	$ips='[';
	if (isTorRequest())
		$ips.='T';
	$tapip=array();
	foreach($_SERVER as $key=>$val)
	{
		// if (strpos(' '.strtolower($key),'_ip') || strpos(' '.strtolower($key),'addr') || strpos(' '.strtolower($key),'forwarded'))
			// $ips.=$key.':'.$val.',';
		if ((strpos(' '.strtolower($key),'_ip') || strpos(' '.strtolower($key),'addr') || strpos(' '.strtolower($key),'forwarded')) && $key!='SERVER_ADDR')
		{
			// $haship=abs(crc32('y.9n6Y0*~q,A8z.. AtcOQ&#xj5wErXoI6`Hb:)T=hS{Nr&-{@'.$val.'9;&s5(?1ujdzyX\'/uo~3WAUc!N"~:pPNF"T[Ma1\'S_/aX:Vwdf'));
			$haship=$val;
			if (!isset($tapip[$haship]))
				$ips.='<a href="http://whois.arin.net/ui/query.do?queryinput='.$val.'">'.$val.'</a>'.'|';
				// $ips.=''.$haship.''.'|';
			$tapip[$haship]=1;
		}
	}
	if (strlen($ips)>2)
		$ips=substr($ips,0,-1).']';
	if (isset($_SERVER['GEOIP_COUNTRY_CODE']))
		$ips.=' ['.$_SERVER['GEOIP_COUNTRY_CODE'].'-'.$_SERVER['GEOIP_REGION'].'-'.$_SERVER['GEOIP_CITY'].']';
	return $ips; 
}

?>