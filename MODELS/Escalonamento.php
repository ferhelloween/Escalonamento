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
	class Escalonamento
	{
		
		//Atributos da Classe 
		private $id; //ID do Escalonamento 
		private $operadora; //Operadora do Escalonamento 
		private $nivel; //Nível de Escalonamento vai variar de 1 a 10 
		private $contato; //Contato - Nome do funcionário 
		private $funcao; //Função do funcionário 
		private $comercial; //Caso o contato seja comercial 
		private $telefone; //Telefone do Contato 
		private $opcao; //Ramal, opção de digito etc 
		private $celular1; //1º Celular do Contato 
		private $celular2; //2º Celular do Contato 
		private $email; //E-mail do Contato 
		private $horario; //Horario de Atendimento 
		private $escalonarApos; //Tempo para Escalonar o contato 
		private $hc; //Contato horário comercial 
		private $ot; //Fora do horário comercial 
		private $nme; //Nível minimo que pode escalonar 
		private $observacao; //Observações
		private $usr_alt; //Usuário que alterou o Registro  
		private $usr_exc; //Usuário que irá fazer a exclusão do Registro 
		private $hora_exclusao; //Horario da Exclusão do Registro


		function __construct()
		{
			# Construtor vazio 
		}


		################ Métodos Setters and Getters ############### 

		############ Métodos Getters 
		public function getId() { 
			return $this->id; 
		}

		public function getOperadora() { 
			return $this->operadora;
		}

		public function getNivel() { 
			return $this->nivel; 
		}

		public function getContato() { 
			return $this->contato; 
		}

		public function getFuncao() { 
			return $this->funcao; 
		}

		public function getComercial() { 
			return $this->comercial; 
		}

		public function getTelefone() { 
			return $this->telefone;
		}

		public function getOpcao() { 
			return $this->opcao; 
		}

		public function getCelular1() { 
			return $this->celular1; 
		}

		public function getCelular2() { 
			return $this->celular2; 
		}

		public function getEmail() { 
			return $this->email; 
		}

		public function getHorario() { 
			return $this->horario; 
		}

		public function getEscalonarApos() { 
			return $this->escalonarApos; 
		} 

		public function getHc() { 
			return $this->hc; 
		}

		public function getOt() { 
			return $this->ot;
		}

		public function getNme() { 
			return $this->nme; 
		}

		public function getObservacao() { 
			return $this->observacao;
		}

		public function getUserAlt() { 
			return $this->usr_alt;
		} 

		public function getUserExc() { 
			return $this->usr_exc; 
		}

		public function getHoraExclusao() { 
			return $this->hora_exclusao;
		}


		########### Métodos Setters 
		public function setId($id) { 
			$this->id = $id; 
		}

		public function setOperadora($operadora) { 
			$this->operadora = $operadora;
		}

		public function setNivel($nivel) { 
			$this->nivel = $nivel; 
		}

		public function setContato($contato) { 
			$this->contato = $contato; 
		}

		public function setFuncao($funcao) { 
			$this->funcao = $funcao; 
		}

		public function setComercial($comercial) { 
			$this->comercial = $comercial; 
		}

		public function setTelefone($telefone) { 
			$this->telefone = $telefone;
		}

		public function setOpcao($opcao) { 
			$this->opcao = $opcao; 
		}

		public function setCelular1($celular1) { 
			 $this->celular1 = $celular1; 
		}

		public function setCelular2($celular2) { 
			 $this->celular2 = $celular2; 
		}

		public function setEmail($email) { 
			 $this->email = $email; 
		}

		public function setHorario($horario) { 
			 $this->horario = $horario; 
		}

		public function setEscalonarApos($escalonarApos) { 
			$this->escalonarApos = $escalonarApos; 
		} 

		public function setHc($hc) { 
			$this->hc = $hc; 
		}

		public function setOt($ot) { 
			 $this->ot = $ot;
		}

		public function setNme($nme) { 
			 $this->nme = $nme; 
		}

		public function setObservacao($observacao) { 
			 $this->observacao = $observacao;
		} 

		public function setUserAlt($usr_alt) { 
			$this->usr_alt = $usr_alt;
		}

		public function setUserExc($usr_exc) { 
			$this->usr_exc = $usr_exc; 
		}

		public function setHoraExclusa($hora_exclusao) { 
			$this->hora_exclusao = $hora_exclusao;
		}


		############## Métodos Data Access Object ficarão na classe DAO 

	}