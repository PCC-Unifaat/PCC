<?php
	namespace Classes\Controllers;
	class ComorbidadesController{
		function index(){

			
			\Classes\Models\PainelModel::checkLogin('comorbidades');
		}
	}
?>