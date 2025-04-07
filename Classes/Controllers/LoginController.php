<?php
	namespace Classes\Controllers;
	class LoginController{
		function index(){
			$tabela = 'agente';
           
			if(isset($_POST['login'])){
				$email = $_POST['email'];
				$senha = $_POST['senha'];

				if(empty($email) || empty($senha))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos!');
				else{
					$verificar = \Classes\Models\UtilsModel::selecionar($tabela, 'email', $email);
	
					if(!empty($verificar) && $senha == \Classes\Bcrypt::check($senha,$verificar['senha'])){
						$_SESSION['login'] = true;
						$_SESSION['id'] = $verificar['id'];
						$_SESSION['nome'] = $verificar['nome'];
						$_SESSION['matricula'] = $verificar['matricula'];
						$_SESSION['email'] = $verificar['email'];
                        
					}else
						\Classes\Models\UtilsModel::alerta('erro','Usuário ou senha incorreto!');
					
					

				}
			}
			
    

			if(isset($_SESSION['login']))
				\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH);
			else
                \Classes\Views\MainView::render('login');
		}
	}
?>