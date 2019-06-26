
<?php 
	

	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento  


	/**
	*  
	*/
	class Operadoras 
	{
		
		//Atributos da Classe
		private $id; //ID
		private $operadora; //Operadora 
		private $sigla; //Sigla da operadora
		private $observacao; //Observacao sobre a operadora 
		private $usuario; //Usuario que efetuou o registro 
		private $dataRegistro; //Data em que foi criado/ alterado o registro

		//Método construtor		
		function __construct()
		{
			# code...
		} 

		//Métodos Getters 
		public function getId() { 
			return $this->id; 
		}	

		public function getOperadora() {
			return $this->operadora; 
		}

		public function getSigla() { 
			return $this->sigla; 
		} 

		public function getObservacao() { 
			return $this->observacao; 
		} 

		public function getUsuario() { 
			return $this->usuario;
		}

		public function getDataRegistro() { 
			return $this->dataRegistro; 
		}

		//Métodos Setters  
		public function setId($id) {
			$this->id = $id;
		}

		public function setOperadora($operadora) { 
			$this->operadora = $operadora; 
		} 

		public function setSigla($sigla) { 
			$this->sigla = $sigla; 
		} 

		public function setObservacao($observacao) { 
			$this->observacao = $observacao; 
		} 

		public function setUsuario($usuario) { 
			$this->usuario = $usuario; 
		} 

		public function setDataRegistro($dataRegistro) { 
			$this->dataRegistro = $dataRegistro; 
		}


		//Métdos CRUD ficarão na Classe DAO

	}





?> 