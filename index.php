<?php 
	require_once('vendor/autoload.php');
	require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

	include('config.php');
	
	$app = new \Classes\Application();
	$app->run();
	
?>