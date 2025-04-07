<?php
	namespace Classes\Controllers;
	class HipertensosController{
		function index(){

			
			\Classes\Models\PainelModel::checkLogin('hipertensos');
		}
	}
?>