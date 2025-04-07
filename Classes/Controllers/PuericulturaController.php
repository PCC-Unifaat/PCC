<?php
	namespace Classes\Controllers;
	class PuericulturaController{
		function index(){
			
			\Classes\Models\PainelModel::checkLogin('puericultura');	
		}
	}
?>