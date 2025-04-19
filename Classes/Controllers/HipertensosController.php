<?php
	namespace Classes\Controllers;
	use DateTime;
	class HipertensosController{
		function index(){

			if(isset($_GET['exportar'])){
				$header = array('Nome', 'Prontuário', 'Nascimento', 'Insulina', 'Diabetes', 'Observação');
				$pacientes = \Classes\Models\UtilsModel::selecionarTudo('paciente', 'agente_id', $_SESSION['id'], 'nome');
				$hipertensos = array_filter($pacientes, function($paciente) {
					$comorbidade = explode(',', $paciente['comorbidade']);
					return in_array('2', $comorbidade);
				});

				$dados = array_map(function($paciente) {
					$obs = explode('||', $paciente['observacao'])[3];
					$dataNascimento = new DateTime($paciente['nascimento']);
					$comorbidade = explode(',', $paciente['comorbidade']);
					$diabete = (in_array('1', $comorbidade)) ? true : false;
					return [
						$paciente['nome'],
						$paciente['prontuario'],
						$dataNascimento->format('d/m/Y'),
						$diabete ? 'SIM' : '',
						$obs
					];
				}, $hipertensos);

				\Classes\Models\TcpdfModels::exportarTabelaPDF($header, $dados, 'hipertensos');
				exit;
			}
			\Classes\Models\PainelModel::checkLogin('hipertensos');
		}
	}
?>