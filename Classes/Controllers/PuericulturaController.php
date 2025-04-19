<?php
	namespace Classes\Controllers;
	use DateTime;

	class PuericulturaController{
		function index(){
			
			if(isset($_GET['exportar'])){
				$header = array('Nome', 'Prontuário', 'Nascimento', 'Observação');
				$pacientes = \Classes\Models\UtilsModel::selecionarTudo('paciente', 'agente_id', $_SESSION['id'], 'nome');
				$puericultura = array_filter($pacientes, function($paciente) {
					$dataNascimento = new DateTime($paciente['nascimento']);
					$hoje = new DateTime();
					$idade = $hoje->diff($dataNascimento)->y;
					return $idade < 2;
				});
				
				$dados = array_map(function($paciente) {
					$obs = explode('||', $paciente['observacao'])[0];
					$dataNascimento = new DateTime($paciente['nascimento']);
					return [
						$paciente['nome'],
						$paciente['prontuario'],
						$dataNascimento->format('d/m/Y'),
						$obs
					];
				}, $puericultura);

				\Classes\Models\TcpdfModels::exportarTabelaPDF($header, $dados, 'puericultura');
				exit;
			}

			\Classes\Models\PainelModel::checkLogin('puericultura');	
		}
	}
?>