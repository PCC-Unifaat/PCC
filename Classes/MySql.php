<?php
    namespace Classes;
	use PDO;
	use PDOException;
	class MySql{
		private static $pdo;

		public static function conectar(){
			if(self::$pdo == null){
				try{
					self::$pdo = new \PDO('mysql:host='.HOST.';dbname='.DATABASE,USUARIO,SENHA,array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
					
				}catch(\PDOException $e){
					// die('<h2>Erro ao conectar</h2>');
					echo 'Erro: '.$e->getMessage();
				}
			}
			return self::$pdo;
		}

	}
?>