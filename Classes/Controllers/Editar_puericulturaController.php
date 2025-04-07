<?php
	namespace Classes\Controllers;
	class Editar_puericulturaController{
		function index(){
            $tabela = 'paciente';

            $consultas = \Classes\Models\UtilsModel::selecionar('consulta', 'paciente_id', $_GET['id']);

            if(!empty($_GET['id'])){
			    // Verifica se paciente existe e faz parte da tabela puericultura
                $paciente = \Classes\Models\UtilsModel::selecionar('paciente', 'id', $_GET['id']);
                if(!empty($paciente)){
                    $dataNascimento = new \DateTime($paciente['nascimento']);
                    $dataAtual = new \DateTime();
                    $idade = $dataAtual->diff($dataNascimento)->y;

                    if ($idade > 2)
                        \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'puericultura');
                    
                }else
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'puericultura');
            }else
                \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'puericultura');
			
          
            if(isset($_POST['editar-puericultura'])){
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
                $observacao = $_POST['observacao'];
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

                    $obs = explode('||', \Classes\Models\UtilsModel::selecionar($tabela, 'id', $_GET['id'])['observacao']);
                    $obs[0] = $observacao;
                    $obs = implode('||', $obs);
                    $sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET agente_id = ?, nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, comorbidade = ?, legenda_id = ?, observacao = ? WHERE id = ?");
					$sql->execute([$_SESSION['id'],$nome,$prontuario,$cpf,$nascimento,$telefone,$sexo,$comorbidade,$legenda,$obs,$_GET['id']]);

                    if(!empty($ult_consulta) || !empty($prox_consulta)){
                        // Verificar se já existe consulta cadastrada
                        if(empty($consultas)){
                            \Classes\Models\UtilsModel::inserir('consulta',[$_GET['id'],$ult_consulta,$prox_consulta]);
                        }else{
                            $sql = \Classes\MySql::conectar()->prepare("UPDATE `consulta` SET ult_consulta = ?, prox_consulta = ? WHERE paciente_id = ?");
                            $sql->execute([$ult_consulta,$prox_consulta,$_GET['id']]);
                        }
                    }
					
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente atualizado com sucesso!');
				}
            }
			
			\Classes\Models\PainelModel::checkLogin('editar-puericultura');
		}
	}
?>