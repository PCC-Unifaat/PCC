<?php
	namespace Classes\Controllers;
	class ComorbidadesController{
		function index(){
			if(isset($_GET['deletar'])){
				\Classes\Models\UtilsModel::deletar('comorbidade', 'id', $_GET['deletar']);
				\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'comorbidades');
				
			}
			
			\Classes\Models\PainelModel::checkLogin('comorbidades');
		}
	}
?>