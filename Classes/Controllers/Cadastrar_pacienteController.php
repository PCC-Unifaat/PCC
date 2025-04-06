<?php
	namespace Classes\Controllers;
	class Cadastrar_pacienteController{
		function index(){
			$tabela = 'paciente';

			if(isset($_GET['sair']))
				\Classes\Models\PainelModel::logout();
           
			
			// $areaAgente = \Classes\Models\UtilsModel::selecionar('tb_admin.agente','id',$_SESSION['id'])['area_micro'];
			if(isset($_POST['acao'])){
				// print_r($_POST);
				$nome = $_POST['nome'];
				$cpf = $_POST['cpf'];
                $nascimetno = $_POST['nascimetno'];
                $prontuario = $_POST['prontuario'];
				$sexo = @$_POST['sexo'];
				$telefone = $_POST['telefone'];
                $comorbidade = @$_POST['comorbidade'];

				if (!empty($comorbidade))
					$comorbidade = implode(',',$comorbidade);

				if(empty($nome) || empty($cpf) || empty($nascimetno) || empty($sexo))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos obrigatórios!');
				// else if(!\Classes\Models\UtilsModel::validarCPF($cpf))
				// 	\Classes\Models\UtilsModel::alerta('erro','CPF inválido!');
				// else if(!(\Classes\Models\UtilsModel::selecionar($tabela,'cpf',$cpf)))
				// 	\Classes\Models\UtilsModel::alerta('erro','Esse CPF já está cadastrado!');
				else{
					//Cadastrar
                    $sql = \Classes\MySql::conectar()->prepare("INSERT INTO `$tabela` SET agente_id = ?, nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, comorbidade = ?");
					$sql->execute([$_SESSION['id'],$nome,$prontuario,$cpf,$nascimetno,$telefone,$sexo,$comorbidade]);
					
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente cadastrado com sucesso!');
				}
			}

		
			\Classes\Models\PainelModel::checkLogin('cadastrar-paciente');
			
			
		}
	}
?>