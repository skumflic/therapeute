<?php
//This page let initialize the forum by checking for example if the user is logged
session_start();
header('Content-type: text/html;charset=UTF-8');
if(!isset($_SESSION['pseudo']) and isset($_COOKIE['pseudo'], $_COOKIE['password']))
{
	$cnn = mysql_query('select password,id from users where username="'.mysql_real_escape_string($_COOKIE['pseudo']).'"');
	$dn_cnn = mysql_fetch_array($cnn);
	if(sha1($dn_cnn['password'])==$_COOKIE['password'] and mysql_num_rows($cnn)>0)
	{
		$_SESSION['pseudo'] = $_COOKIE['pseudo'];
		$_SESSION['id'] = $dn_cnn['id'];
	}
}
?>
