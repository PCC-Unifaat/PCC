<?php
	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	//local

	/*** Testar mobile ***/
	// define('INCLUDE_PATH', 'http://192.168.214.42/ProjetoFinal/');
	/****/
	define('INCLUDE_PATH', 'http://localhost/PCC/');
	define('INCLUDE_PATH_STATIC', INCLUDE_PATH.'Classes/Views/');
	define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');

	// define('EMAIL_VERIFICACAO', 'recuperacao@paginasdotempo.com.br');

	define('HOST', 'localhost');
	define('DATABASE', 'projeto_final');
	define('USUARIO', 'root');
	define('SENHA', '');

	define('BASE_DIR',__DIR__.'/');

	define('BASE_DIR_PAINEL',__DIR__.'/Classes/Views/');
?>