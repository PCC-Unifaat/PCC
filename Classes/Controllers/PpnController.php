<?php
	namespace Classes\Controllers;
	use DateTime;
	class PpnController{
		function index(){

			if(isset($_GET['exportar'])){
				$header = array('Nome', 'Prontuário', 'Nascimento', 'Telefone', 'Ultimo PPN', 'Observação');
				$pacientes = \Classes\Models\UtilsModel::selecionarTudo('paciente', 'sexo', 'feminino', 'nome');
				$ppn = array_filter($pacientes, function($paciente) {
					$dataNascimento = new DateTime($paciente['nascimento']);
					$hoje = new DateTime();
					$idade = $hoje->diff($dataNascimento)->y;
					return $idade >= 25 && $idade < 65;
				});
				
				$dados = array_map(function($paciente) {
					$obs = explode('||', $paciente['observacao'])[5];
					$dataNascimento = new DateTime($paciente['nascimento']);
					return [
						$paciente['nome'],
						$paciente['prontuario'],
						$dataNascimento->format('d/m/Y'),
						$paciente['telefone'],
						$paciente['ppn'],
						$obs
					];
				}, $ppn);

				\Classes\Models\TcpdfModels::exportarTabelaPDF($header, $dados, 'Mulheres no período fértil');
				exit;
			}
			
			\Classes\Models\PainelModel::checkLogin('ppn');
		}
	}
?>