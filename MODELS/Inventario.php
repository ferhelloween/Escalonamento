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
	class Inventario
	{

		private $id; //Id do registro 
		private $tipo; //Tipo do Item 
		private $patrimonio; //patrimonio  do Item 
		private $numSerie; //Número de Serie do Item 
		private $emprea; //Empresa fabricante 
		private $marca; //Marca do Item 
		private $usuario; //Usuário  
		private $telefone; //Telefone  
		private $ponto; //Ponto 
		private $hostname; //Hostname do equipamento 
		private $software; //Software instalado 
		private $observacao; //Demais observações 
		private $usrAlt; //Usuário que efetuou a última alteração. 

		
		function __construct()
		{
			# Cosntrutor Vazio 
		}


		################# Métodos Getters and Setters 

		########## Métodos Getters 

		public function getId() { 
			return $this->id; 			
		}

		public function getTipo() { 
			return $this->tipo; 
		}

		public function getPatrimonio() { 
			return $this->patrimonio; 
		}

		public function getNumSerie() { 
			return $this->numSerie; 
		}

		public function getEmpresa() { 
			return $this->empresa; 
		}
 
		public function getMarca() { 
			return $this->marca; 
		}

		public function getUsuario() { 
			return $this->usuario; 
		} 

		public function getTelefone() { 
			return $this->telefone; 
		}

		public function getPonto() { 
			return $this->ponto; 
		} 

		public function getHostname() { 
			return $this->hostname; 
		} 

		public function getSoftware() { 
			return $this->software; 
		}

		public function getObservacao() { 
			return $this->observacao; 
		}

		public function getUsrAlt() { 
			return $this->usrAlt;
		}

		######### Métodos Setters 

		public function setId($id) { 
			$this->id = $id; 			
		}

		public function setTipo($tipo) { 
			$this->tipo = $tipo; 
		}

		public function setPatrimonio($patrimonio) { 
			$this->patrimonio = $patrimonio; 
		}

		public function setNumSerie($numSerie) { 
			$this->numSerie = $numSerie; 
		}

		public function setEmpresa($empresa) { 
			$this->empresa = $empresa; 
		}
 
		public function setMarca($marca) { 
			$this->marca = $marca; 
		}

		public function setUsuario($usuario) { 
			$this->usuario = $usuario; 
		} 

		public function setTelefone($telefone) { 
			$this->telefone = $telefone; 
		}

		public function setPonto($ponto) { 
			$this->ponto = $ponto; 
		} 

		public function setHostname($hostname) { 
			$this->hostname = $hostname; 
		} 

		public function setSoftware($software) { 
			$this->software = $software; 
		}

		public function setObservacao($observacao) { 
			$this->observacao = $observacao; 
		}

		public function setUsrAlt($usrAlt) { 
			 $this->usrAlt = $usrAlt;
		}

	}

	//Métodos DAO ficarão na classe DaoInventario


?>