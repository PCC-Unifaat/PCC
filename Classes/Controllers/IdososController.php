<?php
	namespace Classes\Controllers;
	use DateTime;
	class IdososController{
		function index(){

			if(isset($_GET['exportar'])){
				$header = array('Nome', 'Prontuário', 'Nascimento', 'Comorbidades', 'Observação');
				$pacientes = \Classes\Models\UtilsModel::selecionarTudo('paciente', '1', '1', 'nome');
				$idosos = array_filter($pacientes, function($paciente) {
					$dataNascimento = new DateTime($paciente['nascimento']);
					$hoje = new DateTime();
					$idade = $hoje->diff($dataNascimento)->y;
					return $idade >= 65;
					});

				$dados = array_map(function($paciente) {
					$obs = explode('||', $paciente['observacao'])[2];
					$dataNascimento = new DateTime($paciente['nascimento']);
					$comorbidade = explode(',', $paciente['comorbidade']);
					$com = '';
					foreach ($comorbidade as $key => $comorbidadeId) {
						$comorbidades = \Classes\Models\UtilsModel::selecionar('comorbidade', 'id', $comorbidadeId);
						if ($comorbidades) { // Verifica se o registro foi encontrado
							$com .= ucfirst($comorbidades['comorbidade']);
							if ($key !== array_key_last($comorbidade)) {
								$com .= ', ';
							}
						}
					}
					return [
						$paciente['nome'],
						$paciente['prontuario'],
						$dataNascimento->format('d/m/Y'),
						$com,
						$obs
					];
				}, $idosos);

				\Classes\Models\TcpdfModels::exportarTabelaPDF($header, $dados, 'idosos');
				\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'idosos');
				exit;
			}
			
			\Classes\Models\PainelModel::checkLogin('idosos');	
		}
	}
?>