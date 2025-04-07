<?php
	namespace Classes\Controllers;
	class Editar_ppnController{
		function index(){
            $tabela = 'paciente';
            $id = @$_GET['id'];
            if(!empty($id)){
			    // Verifica se paciente existe e faz parte da tabela PPN
                $paciente = \Classes\Models\UtilsModel::selecionar($tabela, 'id', $id);
                if(!empty($paciente)){
                    $dataNascimento = new \DateTime($paciente['nascimento']);
                    $dataAtual = new \DateTime();
                    $idade = $dataAtual->diff($dataNascimento)->y;

                    if ($idade < 25 || $idade > 64 || $paciente['sexo'] != 'feminino') 
                        \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'ppn');
                    
                }else
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'ppn');
            }else
                \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'ppn');
			
          
            if(isset($_POST['editar-ppn'])){
                //Editar paciente
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $nascimento = $_POST['nascimetno'];
                $prontuario = $_POST['prontuario'];
                $telefone = $_POST['telefone'];
                $sexo =@ $_POST['sexo'];
                $ultPpn = $_POST['ult_ppn'];
                $comorbidade = @$_POST['comorbidade'];
                $observacao = $_POST['observacao'];
                $legenda = $_POST['status'];

                $observacao = str_replace('|', '/', $observacao);

                if (!empty($comorbidade))
					$comorbidade = implode(',',$comorbidade);

				if(empty($nome) || empty($cpf) || empty($nascimento) || empty($sexo))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos obrigatórios!');
				else if(strtotime($nascimento) > strtotime(date('Y-m-d')))
					\Classes\Models\UtilsModel::alerta('erro','Data de nascimento inválida!');
				// else if(!\Classes\Models\UtilsModel::validarCPF($cpf))
				// 	\Classes\Models\UtilsModel::alerta('erro','CPF inválido!');
				else if(!empty(\Classes\Models\UtilsModel::selecionar($tabela,'cpf',$cpf)) && $cpf != $paciente['cpf'])
					\Classes\Models\UtilsModel::alerta('erro','Esse CPF já está cadastrado!');
				else{
					//Atualizar

                    $obs = explode('||', $paciente['observacao']);
                    $obs[5] = $observacao;
                    $obs = implode('||', $obs);
                    $sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, comorbidade = ?, legenda_id = ?, ppn = ?, observacao = ? WHERE id = ?");
					$sql->execute([$nome,$prontuario,$cpf,$nascimento,$telefone,$sexo,$comorbidade,$legenda,$ultPpn,$obs,$id]);
					
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente atualizado com sucesso!');
				}
            }
			
			\Classes\Models\PainelModel::checkLogin('editar-ppn');
		}
	}
?>