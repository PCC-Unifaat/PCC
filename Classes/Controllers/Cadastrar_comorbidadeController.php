<?php
	namespace Classes\Controllers;
	class Cadastrar_comorbidadeController{
		function index(){
			$tabela = 'comorbidade';
			
			if(isset($_POST['cadastrar-comorbidade'])){
				$comorbidade = $_POST['comorbidade'];

				if(empty($comorbidade))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos obrigatórios!');
				else{
					//Cadastrar
                   \Classes\Models\UtilsModel::inserir($tabela, [$comorbidade]);
					
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente cadastrado com sucesso!');
				}
			}

		
			\Classes\Models\PainelModel::checkLogin('cadastrar-comorbidade');
			
			
		}
	}
?>