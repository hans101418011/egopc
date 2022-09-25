<?php
	$dbHost='127.0.0.1';
	$dbUser='egopc';
	$dbPW='';
	$db='egopc';
	$dbo = new mysqli($dbHost,$dbUser,$dbPW,$db);

	$dbo->query("SET NAMES utf8");
	$dbo->set_charset("utf8mb4_unicode_ci");

	date_default_timezone_set('Asia/Taipei');
?>