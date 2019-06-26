<?php

	########### CABEÇALHO PHP #####################	

	//#Definir char-set 
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	

	/**
	* 
	*/
	class Fornecedores 
	{

		//atributos da classe 
		private $id; //ID do Fornecedor 
		private $empresa; //Nome da Empresa 
		private $contato; //Contato da empresa 
		private $contatoComercial; //Contato comercial 
		private $funcao; //Funcao do Contato 
		private $telefone; //Telefone do Contato 
		private $celular1; //Celular do Contato
		private $celular2; //Celular 2 do Contato 
		private $email; //E-mail do Fornecedor 
		private $ativo; //Ativo-Equipamento do Fornecedor
		private $fabricante; //Fabricante do Equipamento 
		private $modelo; //Modelo do Equipamento 
		private $host; //Host do Equipamento 
		private $localidade; //Localidade do Equipamento 
		private $servico; //Serviço que o equipamento realizada 
		private $nivelMinimo; //Nível minimo de escalonamento para reqisitar o contato 
		private $observacao; //Observações do Registro 
		private $userAlt; //Usuário que irá alterar o registro


		function __construct()
		{
			# Construtor Vazio 
		}


		################ Métodos Getters and Setters 

		########### Método Getters 
	
		public function getId() { 
			return $this->id; //Retorna o ID
		} 

		public function getEmpresa(){ 
			return $this->empresa; //Retorna a Empresa
		} 

		public function getContato() { 
			return $this->contato; //Retorna o Contato
		}

		public function getContatoComercial() { 
			return $this->contatoComercial; //Retornar se contato é ou não comercial 
		}

		public function getFuncao() { 
			return $this->funcao; //Retorna a função do contato 
		} 

		public function getTelefone() { 
			return $this->telefone; //Retorna o telefone do contato 
		} 

		public function getCelular1() { 
			return $this->celular1; //Retorna o celular 1 do contato 
		} 

		public function getCelular2() { 
			return $this->celular2; //Retorna o celular 2 do contato 
		}

		public function getEmail() { 
			return $this->email; //Retorna o e-mail do contato 
		}

		public function getAtivo() { 
			return $this->ativo; //Retorna o ativo do contato 
		}

		public function getFabricante() { 
			return $this->fabricante; //Retorna o fabricante do ativo  
		}

		public function getModelo() { 
			return $this->modelo; //Retorna o modelo do ativo 
		}

		public function getHost() { 
			return $this->host; //Retorna o host do equipamento 
		} 

		public function getLocalidade() { 
			return $this->localidade; //Retorna a localidade 
		}

		public function getServico() { 
			return $this->servico; //Retorna o Serviço 
		}

		public function getNivelMinimo() { 
			return $this->nivelMinimo; //Retorna o nível mínimo 
		}

		public function getObservacao() { 
			return $this->observacao; //Retorna a observação
		}

		public function getUserAlt() { 
			return $this->userAlt; 
		}


		############ Métodos Setters 
		public function setId($id) { 
			$this->id = $id; //Retorna o ID
		} 

		public function setEmpresa($empresa){ 
			$this->empresa = $empresa; //Retorna a Empresa
		} 

		public function setContato($contato) { 
			$this->contato = $contato; //Retorna o Contato
		}

		public function setContatoComercial($contatoComercial) { 
			$this->contatoComercial = $contatoComercial; //Retornar se contato é ou não comercial 
		}

		public function setFuncao($funcao) { 
			$this->funcao = $funcao; //Retorna a função do contato 
		} 

		public function setTelefone($telefone) { 
			$this->telefone = $telefone; //Retorna o telefone do contato 
		} 

		public function setCelular1($celular1) { 
			$this->celular1 = $celular1; //Retorna o celular 1 do contato 
		} 

		public function setCelular2($celular2) { 
			$this->celular2 = $celular2; //Retorna o celular 2 do contato 
		}

		public function setEmail($email) { 
			$this->email = $email; //Retorna o e-mail do contato 
		}

		public function setAtivo($ativo) { 
			$this->ativo = $ativo; //Retorna o ativo do contato 
		}

		public function setFabricante($fabricante) { 
			$this->fabricante = $fabricante; //Retorna o fabricante do ativo  
		}

		public function setModelo($modelo) { 
			$this->modelo = $modelo; //Retorna o modelo do ativo 
		}

		public function setHost($host) { 
			$this->host = $host; //Retorna o host do equipamento 
		} 

		public function setLocalidade($localidade) { 
			$this->localidade = $localidade; //Retorna a localidade 
		}

		public function setServico($servico) { 
			$this->servico = $servico; //Retorna o Serviço 
		}

		public function setNivelMinimo($nivelMinimo) { 
			$this->nivelMinimo = $nivelMinimo; //Retorna o nível mínimo 
		}

		public function setObservacao($observacao) { 
			$this->observacao = $observacao; //Retorna a observação
		}


		public function setUserAlt($userAlt) { 
			$this->userAlt = $userAlt; 
		}

} 

//Métodos DAO Ficarão na Classe DaoFornecedores

?> 