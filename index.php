<?php 
	require_once('vendor/autoload.php');
	use TCPDF\TCPDF;

	include('config.php');
	
	$app = new \Classes\Application();
	$app->run();
	
?>