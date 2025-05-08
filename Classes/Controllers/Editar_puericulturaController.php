<?php
	namespace Classes\Controllers;
	class Editar_puericulturaController{
		function index(){
            $tabela = 'paciente';
            $id = @$_GET['id'];
            $consultas = \Classes\Models\UtilsModel::selecionar('consulta', 'paciente_id', $id);

            if(!empty($id)){
			    // Verifica se paciente existe e faz parte da tabela puericultura
                $paciente = \Classes\Models\UtilsModel::selecionar($tabela, 'id', $id);
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
                $sexo = @$_POST['sexo'];
                $ult_consulta = $_POST['ult_consulta'];
                $prox_consulta = $_POST['prox_consulta'];
                $observacao = $_POST['observacao'];
                $legenda = $_POST['status'];

                $observacao = str_replace('|', '/', $observacao);
                

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
                    $obs[0] = $observacao;
                    $obs = implode('||', $obs);
                    $sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET nome = ?, prontuario = ?, cpf = ?, nascimento = ?, telefone = ?, sexo = ?, legenda_id = ?, observacao = ? WHERE id = ?");
					$sql->execute([$nome,$prontuario,$cpf,$nascimento,$telefone,$sexo,$legenda,$obs,$id]);

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
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'puericultura');
				}
            }
			
			\Classes\Models\PainelModel::checkLogin('editar-puericultura');
		}
	}
?>