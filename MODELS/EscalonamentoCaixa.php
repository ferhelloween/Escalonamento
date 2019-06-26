<?php

	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=wutf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento  


	/**
	* 
	*/
	class EscalonamentoCaixa
	{
		

		//Atributos da classe 
		private $id; //ID do Escalonamento 
		private $nome; //Nome do Funcionário Caixa 
		private $matricula; //Matricula do Funcionário Caixa 
		private $area; //Área do funcionário 
		private $equipe; //Equipe se é Caixa ou Terceirizada 
		private $funcao; //Função do FUncionário 
		private $telefone; //Telefone do funcionário 
		private $celular1; //Celular do funcionário 
		private $celular2; //Celular 2 do funcionário 
		private $hc; //Atende no horário comercial ? 
		private $ot; //Atende fora do horário comercial ? 
		private $fds; //Atende aos finais de semana ? 
		private $mad; //Atende de madrugada ? 
		private $plantao; //É plantonista ? 
		private $escalonar; //Tempo para escalonamento 
		private $niv_min; //Nível Mínimo de escalonamento 
		private $observacao; //Observação 
		private $userAlt; //Usuario que irá fazer alterações 


		function __construct()
		{
			# Construtor ficará vazio. 
		}


		########## Métodos Getters and Setters 

		############# Métodos Getters 
		public function getId() { 
			return $this->id; //Retorna o ID		
		}	

		public function getNome() { 
			return $this->nome; //Retorna o nome
		}

		public function getMatricula() { 
			return $this->matricula; //Retorna a matricula
		} 

		public function getArea() { 
			return $this->area; //Retorna a área 
		}

		public function getEquipe() { 
			return $this->equipe; //Retorna a equipe
		}

		public function getFuncao() { 
			return $this->funcao; //Retorna a função 
		}

		public function getTelefone() { 
			return $this->telefone; //Retorna o telefone
		}

		public function getCelular1() { 
			return $this->celular1; //Retorna o celular
		}

		public function getCelular2() { 
			return $this->celular2; //Retorna o celular 2
		}

		public function getHc() { 
			return $this->hc; //Retorna se atende horário comnercial
		}

		public function getOt() { 
			return $this->ot; //Retorna ses atende fora do horário comercial 
		}
		
		public function getFds() { 
			return $this->fds; //Retorna se atende final de semana 
		}

		public function getMad() { 
			return $this->mad; //Retorna se atende de madrugada
		}

		public function getPlantao() { 
			return $this->plantao; //Retorna se faz ou não plantão 
		}

		public function getEscalonar() { 
			return $this->escalonar; //Retorna o horário para escalonar
		}

		public function getNivMin() { 
			return $this->niv_min; //Retorna o nível minimo de escalonamento 
		}

		public function getObservacao() { 
			return $this->observacao; //Retorna Observacao
		}

		public function getUserAlt() { 
			return $this->userAlt; //Retorna usuário que alterou a página
		}


		########## Métodos Setters 
		public function setId($id) { 
			$this->id = $id; //Seta o ID		
		}	

		public function setNome($nome) { 
			$this->nome = $nome; //Seta o nome
		}

		public function setMatricula($matricula) { 
			$this->matricula = $matricula; //Seta a matricula
		} 

		public function setArea($area) { 
			$this->area = $area; //Seta a área 
		}

		public function setEquipe($equipe) { 
			$this->equipe = $equipe; //Seta a equipe
		}

		public function setFuncao($funcao) { 
			$this->funcao = $funcao; //Seta a função 
		}

		public function setTelefone($telefone) { 
			$this->telefone = $telefone; //Seta o telefone
		}

		public function setCelular1($celular1) { 
			$this->celular1 = $celular1; //Seta o celular
		}

		public function setCelular2($celular2) { 
			$this->celular2 = $celular2; //Seta o celular 2
		}

		public function setHc($hc) { 
			$this->hc = $hc; //Seta se horario de atendimento é o  comnercial
		}

		public function setOt($ot) { 
			$this->ot = $ot; //Seta o horário de atendimento é fora do período comercial
		}
		
		public function setFds($fds) { 
			$this->fds = $fds; //Seta se horario de atendimento é final de semana 
		}

		public function setMad($mad) { 
			$this->mad = $mad; //Seta se horario de atendimento é final de semana
		}

		public function setPlantao($plantao) { 
			$this->plantao = $plantao; //Seta se o funcionário faz plantão 
		}

		public function setEscalonar($escalonar) { 
			$this->escalonar = $escalonar; //Seta o horário para escalonamento
		}

		public function setNivMin($niv_min) { 
			$this->niv_min = $niv_min; //Seta  o nível minimo de escalonamento 
		}

		public function setObservacao($observacao) { 
			$this->observacao = $observacao; //Seta a observação 
		}

		public function setUserAlt($userAlt) { 
			$this->userAlt = $userAlt; //Seta o usuário que efetuar a última alteração
		}

		//Métodos Data Acesse Object ficarão na classe Dao

	}


?>