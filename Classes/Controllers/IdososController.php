<?php
	namespace Classes\Controllers;
	class IdososController{
		function index(){
			
			\Classes\Models\PainelModel::checkLogin('idosos');	
		}
	}
?>