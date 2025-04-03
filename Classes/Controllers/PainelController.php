<?php
	namespace Classes\Controllers;
	class PainelController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			

			if(isset($_SESSION['login']))
				\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'pacientes');
			else
				\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'login');
			
			
			
		}
	}
?>