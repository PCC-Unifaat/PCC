<?php
	namespace Classes\Controllers;
	class PuericulturaController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			

			
			
			\Classes\Models\PainelModel::checkLogin('puericultura');
			
			
			
		}
	}
?>