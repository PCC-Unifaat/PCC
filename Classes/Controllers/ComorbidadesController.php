<?php
	namespace Classes\Controllers;
	class ComorbidadesController{
		function index(){
			$tabela = 'paciente';

			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
           
			
			// $areaAgente = \Classes\Models\UtilsModel::selecionar('tb_admin.agente','id',$_SESSION['id'])['area_micro'];
		

		
			\Classes\Models\PainelModel::checkLogin('comorbidades');
			
			
		}
	}
?>