<?php
	namespace Classes\Controllers;
	class PpnController{
		function index(){
			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
			

			
			
			\Classes\Models\PainelModel::checkLogin('ppn');
			
			
			
		}
	}
?>