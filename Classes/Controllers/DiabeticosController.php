<?php
	namespace Classes\Controllers;
	use DateTime;
	class DiabeticosController{
		function index(){

			if(isset($_GET['exportar'])){
				$header = array('Nome', 'Prontuário', 'Nascimento', 'Insulina', 'Hipertenso', 'Observação');
				$pacientes = \Classes\Models\UtilsModel::selecionarTudo('paciente', '1', '1', 'nome');
				$diabetes = array_filter($pacientes, function($paciente) {
					$comorbidade = explode(',', $paciente['comorbidade']);
					return in_array('1', $comorbidade);
				});

				$dados = array_map(function($paciente) {
					$obs = explode('||', $paciente['observacao'])[4];
					$dataNascimento = new DateTime($paciente['nascimento']);
					$comorbidade = explode(',', $paciente['comorbidade']);
					$hipertenso = (in_array('2', $comorbidade)) ? true : false;
					$insulina = $paciente['insulina'] ? 'Sim' : '';
					return [
						$paciente['nome'],
						$paciente['prontuario'],
						$dataNascimento->format('d/m/Y'),
						$insulina,
						$hipertenso ? 'SIM' : '',
						$obs
					];
				}, $diabetes);

				\Classes\Models\TcpdfModels::exportarTabelaPDF($header, $dados, 'Diabeticos');
				exit;
			}
			
			\Classes\Models\PainelModel::checkLogin('diabeticos');	
		}
	}
?>