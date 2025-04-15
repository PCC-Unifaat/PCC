<?php
	namespace Classes\Controllers;
	use DateTime;
	class CriancasController{
		function index(){
			
			if(isset($_GET['exportar'])){
				$header = array('Nome', 'Prontuário', 'Nascimento', 'Vacina dengue', 'Vacina febre amarela', 'Observação');
				$pacientes = \Classes\Models\UtilsModel::selecionarTudo('paciente', '1', '1', 'nome');
				$criancas = array_filter($pacientes, function($paciente) {
					$dataNascimento = new DateTime($paciente['nascimento']);
					$hoje = new DateTime();
					$idade = $hoje->diff($dataNascimento)->y;
					return $idade >= 10 && $idade < 15;
				});
				
				$dados = array_map(function($paciente) {
					$obs = explode('||', $paciente['observacao'])[1];
					$dataNascimento = new DateTime($paciente['nascimento']);
					$vacinaDengue = $paciente['vacina_dengue'] ? 'Sim' : '';
					$vacinaFebreAmarela = $paciente['vacina_febre_amarela'] ? 'Sim' : '';
					return [
						$paciente['nome'],
						$paciente['prontuario'],
						$dataNascimento->format('d/m/Y'),
						$vacinaDengue,
						$vacinaFebreAmarela,
						$obs
					];
				}, $criancas);

				\Classes\Models\TcpdfModels::exportarTabelaPDF($header, $dados, 'crianças');
				exit;
			}
			
			\Classes\Models\PainelModel::checkLogin('crianca');
		}
	}
?>