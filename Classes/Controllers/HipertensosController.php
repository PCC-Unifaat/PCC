<?php
	namespace Classes\Controllers;
	class HipertensosController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			

			
			
			\Classes\Models\PainelModel::checkLogin('hipertensos');
			
			
			
		}
	}
?>