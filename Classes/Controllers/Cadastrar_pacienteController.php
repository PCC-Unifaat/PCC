<?php
	namespace Classes\Controllers;
	class Cadastrar_pacienteController{
		function index(){
			$tabela = 'paciente';

			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
           
			
			// $areaAgente = \Classes\Models\UtilsModel::selecionar('tb_admin.agente','id',$_SESSION['id'])['area_micro'];
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$cpf = $_POST['cpf'];
                $nascimetno = $_POST['nascimetno'];
                $prontuario = $_POST['prontuario'];
                $comorbidade = @$_POST['comorbidade'];
				if (!empty($comorbidade))
					$comorbidade = implode(',',$comorbidade);
				if(empty($nome) || empty($cpf) || empty($nascimetno))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos obrigatórios!');
				else{
					//Cadastrar
                    $sql = \Classes\MySql::conectar()->prepare("INSERT INTO `$tabela` SET agente_id = ?, nome = ?, cpf = ?, nascimento = ?, prontuario = ?, comorbidade = ?");
					$sql->execute([$_SESSION['id'],$nome,$cpf,$nascimetno,$prontuario,$comorbidade]);
					
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente cadastrado com sucesso!');
				}
			}

		
			\Classes\Models\PainelModel::checkLogin('cadastrar-paciente');
			
			
		}
	}
?>