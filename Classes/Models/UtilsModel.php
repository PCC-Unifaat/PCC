<?php
    namespace Classes\Models;

    class UtilsModel{
        public static function alerta($tipo,$mensagem){
			if($tipo == 'sucesso'){
				echo '<div class="box-alert sucesso"><i class="fas fa-check-circle"></i> '.$mensagem.'</div>';
			}else if($tipo == 'erro'){
				echo '<div class="box-alert erro"><i class="fas fa-times-circle"></i> '.$mensagem.'</div>';
			}
		}

		public static function redirecionar($url){
			echo '<script>window.location.href="'.$url.'"</script>';
			die();
		}

		public static function inserir($tabela,$array){
			$campos = '';
			for($i = 0; $i < count($array); $i++){
				$campos .= '?';
				if($i != count($array) - 1){
					$campos .= ',';
				}
			}

			$sql = \Classes\MySql::conectar()->prepare("INSERT INTO `$tabela` VALUES(null,".$campos.",ativo = '1')");
            $sql->execute($array);
		}

		public static function selecionar($tabela,$campo = '1',$valor = '1'){
			$sql = \Classes\MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE `ativo`= '1' AND $campo = ?");
			$sql->execute(array($valor));
			return $sql->fetch();
		}

		public static function selecionarTudo($tabela,$campo = '1',$valor = '1',$coluna = 'id',$ordem = 'ASC'){
			$sql = \Classes\MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE `ativo` = '1' AND $campo = ? ORDER BY $coluna $ordem");
			$sql->execute(array($valor));
			return $sql->fetchAll();
		}

		public static function busca($tabela,$coluna = '1',$busca = '1',$ordem = 'id'){
			$sql = \Classes\MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE `ativo`= '1' AND agente_id = ? AND `$coluna` LIKE ? ORDER BY $ordem ");
			$sql->execute(array($_SESSION['id'],'%'.$busca.'%'));
			
			return $sql->fetchAll();
		}

		
		public static function deletar($tabela,$campo,$valor){
			$sql = \Classes\MySql::conectar()->prepare("UPDATE `$tabela` SET `ativo` = '0' WHERE $campo = ?");
			$sql->execute(array($valor));
		}

		public static function validarCPF($cpf){
			$cpf = preg_replace('/[^0-9]/', '', $cpf);

			if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
				return false;
			}

			for ($t = 9; $t < 11; $t++) {
				$d = 0;
				for ($c = 0; $c < $t; $c++) {
					$d += $cpf[$c] * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf[$c] != $d) {
					return false;
				}
			}

			return true;
		}
    }
?>