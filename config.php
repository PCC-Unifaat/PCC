<?php
	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	//local

	/*** Testar mobile ***/
	// define('INCLUDE_PATH', 'http://192.168.214.42/ProjetoFinal/');
	/****/
	# Servidor
	// define('INCLUDE_PATH', 'https://healthhubatibaia.online/');
	# Local
	define('INCLUDE_PATH', 'http://localhost/PCC/');
	define('INCLUDE_PATH_STATIC', INCLUDE_PATH.'Classes/Views/');
	define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');

	# BD Local
	define('HOST', 'localhost');
	define('DATABASE', 'projeto_conclusao');
	define('USUARIO', 'root');
	define('SENHA', '');

	# BD Servidor
	// define('HOST', 'localhost');
	// define('DATABASE', 'keving22_projeto_conclusao');
	// define('USUARIO', 'keving22');
	// define('SENHA', 'yU^zT42NqzP!V!');

	define('BASE_DIR',__DIR__.'/');

	define('BASE_DIR_PAINEL',__DIR__.'/Classes/Views/');
?>