<?php
	if(!defined('APP')) die('...');

	include 'adodb5/adodb.inc.php';

	$conn = ADONewConnection('mysqli');
	$conn->Connect('localhost', 'user', 'pass', 'table');
	$conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$conn->Execute('SET NAMES "utf8"');
	$conn->Execute('SET CHARACTER SET utf8_turkish_ci');
	$conn->Execute('SET COLLATION_CONNECTION = "utf8_turkish_ci"');
	$conn->debug = false;

	function print_pre($s)
	{
		echo "<pre>";
		print_r($s);
		echo "</pre>";
	}
