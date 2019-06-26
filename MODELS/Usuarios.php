<?php 

	//Classe onde ficará atribuida os usuários 
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
 
	//Classe Usuarios que irá conter os atributos dos usuários 


 	class Usuarios

 	{
 		
 		//Atributos da classe 
 		private $id; //ID do Registro do usuário 
 		private $login; //Login de Rede do usuário na Caixa 
 		private $nome; //Nome Completo do Usuário 
 		private $area; //Área do Funcionário 
 		private $nivel; //Nivel de Permissão para o Funcionário 	

 		//método Construtor 
 		function __construct()
 		{
 			# code... Vazio 
 		} 


 		########Métodos Getters e Setters 

 		//Métodos Getters 

 		//ID
 		public function getId() { 
 			return $this->id; 
 		} 

 		//login 
 		public function getLogin() { 
 			return $this->login; 
 		} 

 		//Nome 
 		public function getNome() { 
 			return $this->nome;
 		} 

 		//Area 
 		public function getArea() { 
 			return $this->area; 
 		} 

 		//Nivel
 		public function getNivel() { 
 			return $this->nivel;
 		} 


 		//Métodos Setters 

 		//ID
 		public function setId($id) { 
 			$this->id = $id; 
 		} 

 		//Login
 		public function setLogin($login) { 
 			$this->login = $login; 
 		} 

 		//Nome 
 		public function setNome($nome) { 
 			$this->nome = $nome; 
 		}
  
  		//Area 
  		public function setArea($area) { 
  			$this->area = $area; 
  		}

  		//Nivel 
  		public function setNivel($nivel) { 
  			$this->nivel = $nivel;
  		}


 	} 

 	//Fim da Classe PHP - as funções de DATA Access Object ficarão na classe DaoUsuarios 

 ?>	