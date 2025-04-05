<?php
	namespace Classes\Controllers;
	class IdososController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			

			
			
			\Classes\Models\PainelModel::checkLogin('idosos');
			
			
			
		}
	}
?>