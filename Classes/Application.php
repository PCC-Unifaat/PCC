<?php 
	namespace Classes;
	class Application{
		private $controller;

		private function setApp(){
			$carregarClasse= 'Classes\Controllers\\';
			$url = explode('/',@$_GET['url']);
			
			if($url[0] == '')
				$carregarNome= 'Painel';
			else
				$carregarNome= ucfirst(strtolower($url[0]));

			$carregarNome.='Controller';

			$carregarClasse.=$carregarNome;
			
			if (file_exists('Classes/Controllers/'.$carregarNome.'.php')) {
				$this->controller = new $carregarClasse();
			}else{
				include('Views/pages/404.php');
				die();
			}
		}
		
		public function run(){
	        $this->setApp();
	        $this->controller->index();
	    }
	}
?>