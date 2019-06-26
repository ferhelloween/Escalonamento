<?php 

	
	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento  


	
	class Rh
	{
		
		private $id; //ID do Registro 
		private $matricula; //MAtricula ddo funcionário
		private $nome; //Nome do Funcionário 
		private $empresa; //Empresa do Funcionário 
		private $funcao; //Função do Funcionário 
		private $grupoGsc; //Grupo GSC 
		private $ramal; //Ramal 
		private $celular; //Celular 
		private $userAlt; //Usuario que irá fazer alterações 
  



		function __construct()
		{
			# Construtor Vazio
		}
	
		################ Métodos Getters and Setters 

		######## Métodos Getters

		public function getId() { 
			return $this->id; 
		}

		public function getMatricula() { 
			return $this->matricula; 
		}

		public function getNome() { 
			return $this->nome; 
		}

		public function getEmpresa() { 
			return $this->empresa; 
		}

		public function getFuncao() { 
			return $this->funcao; 
		}

		public function getGrupoGsc() { 
			return $this->grupoGsc; 
		}

		public function getRamal() { 
			return $this->ramal;
		} 

		public function getCelular() { 
			return $this->celular;
		}

		public function getUserAlt() { 
			return $this->userAlt; //Retorna usuário que alterou a página
		}


		######## Métodos Setters 
		public function setId($id) { 
			$this->id = $id; 
		}

		public function setMatricula($matricula) { 
			$this->matricula = $matricula; 
		}

		public function setNome($nome) { 
			$this->nome = $nome; 
		}

		public function setEmpresa($empresa) { 
			$this->empresa = $empresa; 
		}

		public function setFuncao($funcao) { 
			$this->funcao= $funcao; 
		}

		public function setGrupoGsc($grupoGsc) { 
			$this->grupoGsc = $grupoGsc; 
		}

		public function setRamal($ramal) { 
			$this->ramal = $ramal;
		} 

		public function setCelular($celular) { 
			$this->celular = $celular;
		}

		public function setUserAlt($userAlt) { 
			$this->userAlt = $userAlt; //Seta o usuário que efetuar a última alteração
		}

		//Métodos Data Acesse Object ficarão na classe Dao

	}


?>