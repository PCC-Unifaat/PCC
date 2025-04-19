<?php
	namespace Classes\Controllers;
	class CadastrarController{
		function index(){
			$tabela = 'agente';
			
			if(isset($_POST['cadastrar-agente'])){
				
				// Verificar dados
				$nome = $_POST['nome'];
				$matricula = $_POST['matricula'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];
				$confirmaSenha = $_POST['confirma_senha'];
				
				if(empty($nome) || empty($email) || empty($matricula) || empty($senha) || empty($confirmaSenha))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos!');
				else if(!is_numeric($matricula))
					\Classes\Models\UtilsModel::alerta('erro','A matrícula deve conter apenas números!');
				else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
					\Classes\Models\UtilsModel::alerta('erro','Formato de E-mail inválido!');
				else if (strlen($senha) < 6)
					\Classes\Models\UtilsModel::alerta('erro','A senha deve conter pelo menos 6 caracteres!');
				else if (!preg_match('/[A-Za-z]/', $senha) || !preg_match('/[0-9]/', $senha))
					\Classes\Models\UtilsModel::alerta('erro','A senha deve conter letras e números!');
				else if($senha != $confirmaSenha)
					\Classes\Models\UtilsModel::alerta('erro','As senhas estão diferentes!');
				else if(!empty(\Classes\Models\UtilsModel::selecionar($tabela, 'email', $email)))
					\Classes\Models\UtilsModel::alerta('erro','E-mail já cadastrado!');
				else{
					//Cadastrar

					$senha = \Classes\Bcrypt::hash($senha);
					\Classes\Models\UtilsModel::inserir($tabela,[$nome,$matricula,$email,$senha]);
					$verificar = \Classes\Models\UtilsModel::selecionar($tabela, 'email', $email);
					$_SESSION['login'] = true;
					$_SESSION['id'] = $verificar['id'];
					$_SESSION['nome'] = $verificar['nome'];
					$_SESSION['email'] = $verificar['email'];
					\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH);

				}
				
			}

		
			\Classes\Models\PainelModel::checkLogin('cadastrar-agente', false);
			
			
		}
	}
?>