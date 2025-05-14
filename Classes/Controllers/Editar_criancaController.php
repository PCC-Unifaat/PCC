<?php
	namespace Classes\Controllers;
	class Editar_criancaController{
		function index(){
            $tabela = 'paciente';
            $id = @$_GET['id'];
            if(!empty($id)){
			    // Verifica se paciente existe e faz parte da tabela crianca
                $paciente = \Classes\Models\UtilsModel::selecionar($tabela, 'id', $id);
                if(!empty($paciente)){
                    $dataNascimento = new \DateTime($paciente['nascimento']);
                    $dataAtual = new \DateTime();
                    $idade = $dataAtual->diff($dataNascimento)->y;

                    if ($idade < 10 || $idade > 14) 
                        \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'crianca');
                    
                }else
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'crianca');
            }else
                \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'crianca');
			
          
            if(isset($_POST['editar-crianca'])){
                //Editar paciente
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $nascimento = $_POST['nascimetno'];
                $prontuario = $_POST['prontuario'];
                $telefone = $_POST['telefone'];
                $sexo =@ $_POST['sexo'];
                $comorbidade = @$_POST['comorbidade'];
                $observacao = $_POST['observacao'];
                $vacinaDengue = @$_POST['vacina_dengue'];
                $vacinaFebreAmarela = @$_POST['vacina_febre_amarela'];
                $legenda = $_POST['status'];

                $observacao = str_replace('|', '/', $observacao);

                if (!empty($comorbidade))
					$comorbidade = implode(',',$comorbidade);

				if(empty($nome) || empty($cpf) || empty($nascimento) || empty($sexo))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos obrigatórios!');
				else if(strtotime($nascimento) > strtotime(date('Y-m-d')))
					\Classes\Models\UtilsModel::alerta('erro','Data de nascimento inválida!');
				else if(!\Classes\Models\UtilsModel::validarCPF($cpf))
					\Classes\Models\UtilsModel::alerta('erro','CPF inválido!');
				else if(!empty(\Classes\Models\UtilsModel::selecionar($tabela,'cpf',$cpf)) && $cpf != $paciente['cpf'])
					\Classes\Models\UtilsModel::alerta('erro','Esse CPF já está cadastrado!');
				else{
					//Atualizar

                    $obs = explode('||', $paciente['observacao']);
                    $obs[1] = $observacao;
                    $obs = implode('||', $obs);
                    $sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, comorbidade = ?, legenda_id = ?, vacina_dengue = ?, vacina_febre_amarela = ?, observacao = ? WHERE id = ?");
					$sql->execute([$nome,$prontuario,$cpf,$nascimento,$telefone,$sexo,$comorbidade,$legenda,$vacinaDengue,$vacinaFebreAmarela,$obs,$id]);
					
					// \Classes\Models\UtilsModel::alerta('sucesso','Paciente atualizado com sucesso!');
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'criancas');
				}
            }
			
			\Classes\Models\PainelModel::checkLogin('editar-crianca');
		}
	}
?>