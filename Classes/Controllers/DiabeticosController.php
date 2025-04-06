<?php
	namespace Classes\Controllers;
	class DiabeticosController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			

			
			
			\Classes\Models\PainelModel::checkLogin('diabeticos');
			
			
			
		}
	}
?>