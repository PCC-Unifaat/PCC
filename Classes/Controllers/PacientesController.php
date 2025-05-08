<?php
	namespace Classes\Controllers;
	class PacientesController{
		function index(){
			
			

			
			
			\Classes\Models\PainelModel::checkLogin('pacientes');	
		}
	}
?>