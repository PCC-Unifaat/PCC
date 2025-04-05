<?php
	namespace Classes\Controllers;
	class CriancasController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			

			
			
			\Classes\Models\PainelModel::checkLogin('crianca');
			
			
			
		}
	}
?>