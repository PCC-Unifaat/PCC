<?php
	namespace Classes\Controllers;
	class Editar_gestanteController{
		function index(){
            $tabela = 'paciente';
            $id = @$_GET['id'];

            if(!empty($id)){
			    // Verifica se paciente existe e faz parte da tabela idoso
                $paciente = \Classes\Models\UtilsModel::selecionar($tabela, 'id', $id);
                if(!empty($paciente)){
                    if(empty($paciente['gestante']))
                        \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'gestantes');
                }else
                    \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'gestantes');
            }else
                \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'gestantes');
			
          
            if(isset($_POST['editar-gestante'])){
                //Editar paciente
                $nome = $_POST['nome'];
                $prontuario = $_POST['prontuario'];
                $telefone = $_POST['telefone'];
                $dum = $_POST['dum'];
                $dpp = $_POST['dpp'];
                $altoRisco = @$_POST['alto_risco'];
                $parto = $_POST['parto'];
                $conduta = $_POST['conduta'];
                $observacao = $_POST['observacao'];
                $legenda = $_POST['status'];

                $observacao = str_replace('|', '/', $observacao);

				if(empty($nome))
					\Classes\Models\UtilsModel::alerta('erro','Preencha todos os campos obrigatórios!');
				else{
					//Atualizar

                    $obs = explode('||', $paciente['observacao']);
                    $obs[6] = $observacao;
                    $obs = implode('||', $obs);
                    $sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET nome = ?, prontuario = ?, telefone = ?, legenda_id = ?, observacao = ? WHERE id = ?");
					$sql->execute([$nome,$prontuario,$telefone,$legenda,$obs,$id]);
                    $atualiza = \Classes\MySql::conectar()->prepare("UPDATE `gestante` SET dum = ?, dpp = ?, alto_risco = ?, conduta = ?, parto = ? WHERE paciente_id = ?");
					$atualiza->execute([$dum,$dpp,$altoRisco,$conduta,$parto,$id]);
					
					\Classes\Models\UtilsModel::alerta('sucesso','Paciente atualizado com sucesso!');
				}
            }
			
			\Classes\Models\PainelModel::checkLogin('editar-gestante');
		}
	}
?>