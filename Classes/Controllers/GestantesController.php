<?php
	namespace Classes\Controllers;
	class GestantesController{
		function index(){
			
			

			
			
			\Classes\Models\PainelModel::checkLogin('gestantes');	
		}
	}
?>