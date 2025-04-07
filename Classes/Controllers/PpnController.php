<?php
	namespace Classes\Controllers;
	class PpnController{
		function index(){
			
			\Classes\Models\PainelModel::checkLogin('ppn');
		}
	}
?>