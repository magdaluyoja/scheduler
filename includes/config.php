<?php
	require_once("libraries/adodb5/adodb.inc.php");
	$conn	=	newADOConnection("mysqli");
	$RSconn	=	$conn->Connect("localhost","root","");
	if($RSconn == false)
	{
		die("Unable to connect to the database.");
	}

	define("DB","task");
?>