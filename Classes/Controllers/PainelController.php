<?php
	namespace Classes\Controllers;
	class PainelController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();  

				
			
			\Classes\Models\PainelModel::checkLogin('painel');	
		}
	}
?>