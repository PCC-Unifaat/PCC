<?php
	namespace Classes\Controllers;
	class Editar_pacienteController{
		function index(){
            $tabela = 'paciente';
            $id = @$_GET['id'];
            $consultas = \Classes\Models\UtilsModel::selecionar('consulta', 'paciente_id', $id);
            if(!empty($id)){
			    // Verifica se paciente existe e faz parte da tabela crianca
                $paciente = \Classes\Models\UtilsModel::selecionar($tabela, 'id', $id);
                if(empty($paciente))
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'pacientes');
            }else
                \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'pacientes');
			
            if(isset($_GET['deletar'])){
                //Deletar paciente
                // \Classes\Models\UtilsModel::alerta('sucesso','Paciente deletado com sucesso!');
                \Classes\Models\UtilsModel::deletar($tabela,'id',$id);
                \Classes\Models\UtilsModel::deletar('consulta','paciente_id',$id);
                \Classes\Models\UtilsModel::deletar('gestante','paciente_id',$id);
                \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'pacientes');
            }
          
            if(isset($_POST['editar-paciente'])){
                //Editar paciente
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $nascimento = $_POST['nascimetno'];
                $prontuario = $_POST['prontuario'];
                $telefone = $_POST['telefone'];
                $sexo =@ $_POST['sexo'];
                $comorbidade = @$_POST['comorbidade'];
                $ult_consulta = $_POST['ult_consulta'];
                $prox_consulta = $_POST['prox_consulta'];
                $gestante = @$_POST['gestante'];
                $legenda = $_POST['status'];

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
                    $sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, comorbidade = ?, legenda_id = ?, gestante = ? WHERE id = ?");
					$sql->execute([$nome,$prontuario,$cpf,$nascimento,$telefone,$sexo,$comorbidade,$legenda,$gestante,$id]);
					
                    $gest = \Classes\Models\UtilsModel::selecionar($tabela,'id',$id)['gestante'];
                    if(empty($gest)){ 
                        \Classes\Models\UtilsModel::deletar('gestante','paciente_id',$id);
                    }else{
                        $verifica = \Classes\MySql::conectar()->prepare("SELECT * FROM `gestante` WHERE paciente_id = ? ");
			            $verifica->execute(array($id));
                        $verifica = $verifica->fetchAll();
                        if(empty($verifica)){
                            // Verifica se já existe gestante cadastrada
                            $sql = \Classes\MySql::conectar()->prepare("INSERT INTO `gestante` SET paciente_id = ?");
					        $sql->execute([$id]);
                        }else{
                            $sql = \Classes\MySql::conectar()->prepare("UPDATE `gestante` SET `ativo`  = 1 WHERE paciente_id = ?");
                            $sql->execute([$id]);
                        }
                    }

                    if(!empty($ult_consulta) || !empty($prox_consulta)){
                        // Verificar se já existe consulta cadastrada
                        if(empty($consultas)){
                            \Classes\Models\UtilsModel::inserir('consulta',[$id,$ult_consulta,$prox_consulta]);
                        }else{
                            $sql = \Classes\MySql::conectar()->prepare("UPDATE `consulta` SET ult_consulta = ?, prox_consulta = ? WHERE paciente_id = ?");
                            $sql->execute([$ult_consulta,$prox_consulta,$id]);
                        }
                    }

					// \Classes\Models\UtilsModel::alerta('sucesso','Paciente atualizado com sucesso!');
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'pacientes');
				}
            }
			
			\Classes\Models\PainelModel::checkLogin('editar-paciente');
		}
	}
?>