<?php
	namespace Classes\Controllers;
	class DiabeticosController{
		function index(){
			
			\Classes\Models\PainelModel::checkLogin('diabeticos');	
		}
	}
?>