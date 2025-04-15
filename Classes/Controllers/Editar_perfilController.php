<?php
	namespace Classes\Controllers;
	class Editar_perfilController{
		function index(){
			$tabela = 'agente';
			$agente = \Classes\Models\UtilsModel::selecionar($tabela,'id',$_SESSION['id']);
			if(isset($_POST['editar-perfil'])){
				
				// Verificar dados
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];

				if(empty($nome) || empty($email) || empty($senha))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos!');
				else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
					\Classes\Models\UtilsModel::alerta('erro','Formato de E-mail inválido!');
				else if (strlen($senha) < 6)
					\Classes\Models\UtilsModel::alerta('erro','A senha de conter pelo menos 6 caracters!');
				else if(!\Classes\Bcrypt::check($senha,$agente['senha']))
					\Classes\Models\UtilsModel::alerta('erro','Senha incorreta!');
				else if(!empty(\Classes\Models\UtilsModel::selecionar($tabela, 'email', $email)) && $agente['email'] != $email)
					\Classes\Models\UtilsModel::alerta('erro','E-mail já cadastrado!');
				else{
					//Cadastrar
					\Classes\Models\UtilsModel::alerta('sucesso','Perfil atualizado com sucesso!');

					$sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET nome = ?, email = ? WHERE id = ?");
					$sql->execute([$nome,$email,$agente['id']]);

					$_SESSION['nome'] = $nome;
					$_SESSION['email'] = $email;
				}
				
			}
			
			if(isset($_POST['atualiza-senha'])){
				$senhaAtual = $_POST['senha-atual'];
				$senha = $_POST['senha'];
				$confirmaSenha = $_POST['confirmar_senha'];

				if(empty($senhaAtual) || empty($senha) || empty($confirmaSenha))
					\Classes\Models\UtilsModel::alerta('erro','Preenha todos os campos!');
				else if(!\Classes\Bcrypt::check($senhaAtual, $agente['senha']))
					\Classes\Models\UtilsModel::alerta('erro','A senha atual está incorreta!');
				else if (!\preg_match('/[A-Za-z]/', $senha) || !\preg_match('/[0-9]/', $senha))
					\Classes\Models\UtilsModel::alerta('erro','A senha deve conter letras e números!');
				else if($confirmaSenha != $senha)
					\Classes\Models\UtilsModel::alerta('erro','As senhas estão diferentes!');
				else{
					$senha = \Classes\Bcrypt::hash($senha);
					$sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET senha = ? WHERE id = ?");
					$sql->execute([$senha,$agente['id']]);
					\Classes\Models\UtilsModel::alerta('sucesso','Senha alterada com sucesso!');
				}
					
			}

			\Classes\Models\PainelModel::checkLogin('editar-perfil');
			
		}
	}
?>