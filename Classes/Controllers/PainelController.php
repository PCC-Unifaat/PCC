<?php
	namespace Classes\Controllers;
	class PainelController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			
			print_r($_SESSION);
			
			
			\Classes\Models\PainelModel::checkLogin('painel');	
		}
	}
?>