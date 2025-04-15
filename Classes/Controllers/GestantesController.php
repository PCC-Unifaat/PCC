<?php
	namespace Classes\Controllers;
	
	class GestantesController{
		function index(){
			
			if(isset($_GET['exportar'])){
				$header = array('Nome', 'Prontuário', 'DUM', 'DPP', 'Observação');
				$pacientes = \Classes\Models\UtilsModel::selecionarTudo('paciente', 'sexo', 'feminino', 'nome');
				$gestantes = array_filter($pacientes, function($p) {
					return $p['gestante'] != 0;
				});
				
				$dados = array_map(function($paciente) {
					$obs = explode('||', $paciente['observacao'])[6];
					$gravida = \Classes\Models\UtilsModel::selecionar('gestante', 'paciente_id', $paciente['id']);
					$dum =  ($gravida['dum'] != '0000-00-00') ? date('d/m/Y', strtotime($gravida['dum'])) : '';
					$dpp = ($gravida['dpp'] != '0000-00-00') ? date('d/m/Y', strtotime($gravida['dpp'])) : '';
					
					return [
						$paciente['nome'],
						$paciente['prontuario'],
						$dum,
						$dpp,
						$obs
					];
				}, $gestantes);

				\Classes\Models\TcpdfModels::exportarTabelaPDF($header, $dados, 'gestantes');
				exit;
			}
			
			\Classes\Models\PainelModel::checkLogin('gestantes');	
		}
	}
?>