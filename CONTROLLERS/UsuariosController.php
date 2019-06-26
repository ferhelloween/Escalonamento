<?php 

	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR.utf-8"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais  


	require_once "../MODELS/Usuarios.php";  
	require_once "../MODELS/DaoUsuarios.php"; 

	$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
	$valor = isset($_GET['valor']) ? $_GET['valor'] : '';   

	switch ($opcao) {
		case 'Registrar':
			
			//Busca as Variaveis do Formulário 
			$login = $_REQUEST['nLogin']; //Busca o Login no Formulario 
			$nome = $_REQUEST['nNome']; //Busca o Nome no Formulário
			$area = $_REQUEST['nArea']; //Busca a Area no Formulário
			$nivel = $_REQUEST['nNivel']; //Busca no Nivel no Formulario  

			$usuarios = new Usuarios(); //Instancia um novo objeto da Classe Usuario 
			$daoUsuarios = new DaoUsuarios(); //Instancia um novo objeto  


			//Busca os valores 
			$usuarios->setLogin($login); //Seta o Login 
			$usuarios->setNome($nome); //Seta o nome
			$usuarios->setArea($area); //Seta a area
			$usuarios->setNivel($nivel); //Seta o Nivel  

			//Teste para exibição dos valores 
			
			//echo "Login:{$usuarios->getLogin()}<BR>";
			//echo "Nome:{$usuarios->getNome()}<BR>";
			//echo "Área:{$usuarios->getArea()}<BR>";
			//echo "Nível:{$usuarios->getNivel()}<BR>";
			
			//Executa a função de Cadastro 
			$daoUsuarios->criarUsuario($usuarios);


			break; 

		case 'Alterar':
				
				$id = $_REQUEST['nCod']; 
				$login = $_REQUEST['nLogin']; //Busca o Login no Formulario 
				$nome = $_REQUEST['nNome']; //Busca o Nome no Formulário
				$area = $_REQUEST['nArea']; //Busca a Area no Formulário
				$nivel = $_REQUEST['nNivel']; //Busca no Nivel no Formulario   

				$usuarios = new Usuarios(); 
				$daoUsuarios = new DaoUsuarios(); 

				//Busca os valores 
				$usuarios->setId($id); //Seta o Id 
				$usuarios->setLogin($login); //Seta o Login 
				$usuarios->setNome($nome); //Seta o nome
				$usuarios->setArea($area); //Seta a area
				$usuarios->setNivel($nivel); //Seta o Nivel   

				//Executa a função
				$daoUsuarios->editarUsuario($usuarios);

				break;

		case 'Excluir':
				
				$id = $_REQUEST['excId'];

				$usuarios = new Usuarios(); 
				$daoUsuarios = new DaoUsuarios();  

				$usuarios->setId($id); //Seta o ID que será utilizado 

				$daoUsuarios->excluirUsuario($id); //Chama o método que irá realizar a exclusão	

				break;			
		
		case 'Visualizar':

				//echo "Teste";
			
				$listarUsuarios = new DaoUsuarios(); //Instancia o objeto para a classe DaoUsuarios 
				$listarUsuarios->listarUsuarios(); //Chama a função que exibe os usuarios 

				# code...
				break;		


		default:
			# code...
			break;
	}

?>