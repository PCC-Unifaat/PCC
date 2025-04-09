<?php
	namespace Classes\Controllers;
	class Editar_diabeteController{
		function index(){
            $tabela = 'paciente';
            $id = @$_GET['id'];
            $consultas = \Classes\Models\UtilsModel::selecionar('consulta', 'paciente_id', $id);

            if(!empty($id)){
			    // Verifica se paciente existe e faz parte da tabela Hipertenso
                $paciente = \Classes\Models\UtilsModel::selecionar($tabela, 'id', $id);
                $comorbidade = explode(',', $paciente['comorbidade']);
                $hipertenso = (in_array('1', $comorbidade)) ? true : false;
                if(empty($hipertenso))
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'diabeticos');
                
            }else
                \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'diabeticos');
			
          
            if(isset($_POST['editar-diabetico'])){
                //Editar paciente
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $nascimento = $_POST['nascimetno'];
                $prontuario = $_POST['prontuario'];
                $telefone = $_POST['telefone'];
                $sexo = @$_POST['sexo'];
                $comorbidade = @$_POST['comorbidade'];
                $ult_consulta = $_POST['ult_consulta'];
                $prox_consulta = $_POST['prox_consulta'];
                $insulina = @$_POST['insulina'];
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
                    $obs[4] = $observacao;
                    $obs = implode('||', $obs);
                    $sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, comorbidade = ?, legenda_id = ?, insulina = ?, observacao = ? WHERE id = ?");
					$sql->execute([$nome,$prontuario,$cpf,$nascimento,$telefone,$sexo,$comorbidade,$legenda,$insulina,$obs,$id]);

                    if(!empty($ult_consulta) || !empty($prox_consulta)){
                        // Verificar se já existe consulta cadastrada
                        if(empty($consultas)){
                            \Classes\Models\UtilsModel::inserir('consulta',[$id,$ult_consulta,$prox_consulta]);
                        }else{
                            $sql = \Classes\MySql::conectar()->prepare("UPDATE `consulta` SET ult_consulta = ?, prox_consulta = ? WHERE paciente_id = ?");
                            $sql->execute([$ult_consulta,$prox_consulta,$id]);
                        }
                    }
					
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente atualizado com sucesso!');
				}
            }
			
			\Classes\Models\PainelModel::checkLogin('editar-diabete');
		}
	}
?>