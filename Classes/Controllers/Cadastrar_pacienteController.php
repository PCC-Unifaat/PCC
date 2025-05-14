<?php
	namespace Classes\Controllers;
	class Cadastrar_pacienteController{
		function index(){
			$tabela = 'paciente';
			
			// $areaAgente = \Classes\Models\UtilsModel::selecionar('tb_admin.agente','id',$_SESSION['id'])['area_micro'];
			if(isset($_POST['cadastrar-paciente'])){
				// print_r($_POST);
				$nome = $_POST['nome'];
				$cpf = $_POST['cpf'];
                $nascimento = $_POST['nascimetno'];
                $prontuario = $_POST['prontuario'];
				$sexo = @$_POST['sexo'];
				$telefone = $_POST['telefone'];
                $comorbidade = @$_POST['comorbidade'];

				if (!empty($comorbidade))
					$comorbidade = implode(',',$comorbidade);

				if(empty($nome) || empty($cpf) || empty($nascimento) || empty($sexo))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos obrigatórios!');
				else if(strtotime($nascimento) > strtotime(date('Y-m-d')))
					\Classes\Models\UtilsModel::alerta('erro','Data de nascimento inválida!');
				else if(!\Classes\Models\UtilsModel::validarCPF($cpf))
					\Classes\Models\UtilsModel::alerta('erro','CPF inválido!');
				else if(!empty(\Classes\Models\UtilsModel::selecionar($tabela,'cpf',$cpf)))
					\Classes\Models\UtilsModel::alerta('erro','Esse CPF já está cadastrado!');
				else{
					//Cadastrar
                    $sql = \Classes\MySql::conectar()->prepare("INSERT INTO `$tabela` SET agente_id = ?, nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, comorbidade = ?, observacao = '||||||||||||'");
					$sql->execute([$_SESSION['id'],$nome,$prontuario,$cpf,$nascimento,$telefone,$sexo,$comorbidade]);
					/**
					 * Observação:[
					 *       	 	"0" => "Puericultura",
					 *       	 	"1" => "Crianças",  
					 * 	  	 		"2" => "Idosos",
					 * 				"3" => "Hipertensos",
					 * 				"4" => "Diabéticos",
					 * 				"5" => "Mulheres periodo fertil",
					 * 				"6" => "Gestantes"
					 * 			]
					 * 	Separar os valores por "||".
					 */
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente cadastrado com sucesso!');
				}
			}

		
			\Classes\Models\PainelModel::checkLogin('cadastrar-paciente');
			
			
		}
	}
?>