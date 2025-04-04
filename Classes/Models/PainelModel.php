<?php
	namespace Classes\Models;
	class PainelModel{
		public static function logout(){
			session_destroy();
			\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH);
		}

		// public static function gerarSlug($str){
		// 	$str = mb_strtolower($str);
		// 	$str = preg_replace('/(â|á|ã)/', 'a', $str);
		// 	$str = preg_replace('/(ê|é)/', 'e', $str);
		// 	$str = preg_replace('/(í|Í)/', 'i', $str);
		// 	$str = preg_replace('/(ú)/', 'u', $str);
		// 	$str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
		// 	$str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
		// 	$str = preg_replace('/( )/', '-',$str);
		// 	$str = preg_replace('/ç/','c',$str);
		// 	$str = preg_replace('/(-[-]{1,})/','-',$str);
		// 	$str = preg_replace('/(,)/','-',$str);
		// 	$str=strtolower($str);
		// 	return $str;
		// }

		public static function checkLogin($page){
			// if(isset($_SESSION['login'])){
            //     if($_SESSION['email_verificado'] == 'verificado')
			// 		\Classes\Views\MainView::render($page);
            //     else
            //         \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'autenticar');
			// }else
            //     \Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'login');

			if(isset($_SESSION['login']))
				\Classes\Views\MainView::render($page);
			else
				\Classes\Models\UtilsModel::redirecionar(INCLUDE_PATH.'login');
		}

		public static function arquivoValido($arquivo,$type){
			if (count($arquivo) == count($arquivo, COUNT_RECURSIVE)) {
				$check = $arquivo['type'];
				if($type == 'pdf'){
					if($check == 'application/pdf')
						return true;	
					else
						return false;
					
				}else if($type == 'image'){
					if($check == 'image/jpeg' || $check == 'image/jpg' || $check == 'image/png' || $check == 'image/webp')
						return true;
					else
						return false;
				}else if($type == 'audio'){
					if($check == 'audio/mpeg')
						return true;
					else
						return false;
				}
			} else{
				foreach ($arquivo as $key => $value) {
					$check = $arquivo[$key]['type'];
					
					if($type == 'pdf'){
						if($check == 'application/pdf')
							return true;	
						else
							return false;
						
					}else if($type == 'image'){
						if($check == 'image/jpeg' || $check == 'image/jpg' || $check == 'image/png' || $check == 'image/webp')
							return true;
						else
							return false;
					}else if($type == 'audio'){
						if($check == 'audio/mpeg')
							return true;
						else
							return false;
					}
				}
				
			}
			
			
		}

		public static function uploadFile($file){
			$formatoArquivo = explode('.',$file['name']);
			$arquivoNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'uploads/'.$arquivoNome))
				return $arquivoNome;
			else
				return false;
		}

		public static function deleteFiles($file){
			$file = explode(',',$file);
			foreach ($file as $key => $value) {
				@unlink(BASE_DIR_PAINEL.'uploads/'.$file[$key]);
			}
			
		}

		// public static function verificarOpt($arr){
		// 	$vazio = 0;
		// 	foreach($arr as $key => $value){
		// 		if(empty($arr[$key])) 
		// 			$vazio++;
		// 	}
		//    return $vazio;   
		// }


	}
?>