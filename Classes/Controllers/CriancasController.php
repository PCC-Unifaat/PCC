<?php
	namespace Classes\Controllers;
	class CriancasController{
		function index(){
			
			
			\Classes\Models\PainelModel::checkLogin('crianca');
		}
	}
?>