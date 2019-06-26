
<?php 

	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais  



	require_once "../MODELS/Operadoras.php";  
	require_once "../MODELS/DaoOperadoras.php"; 

	$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
	$valor = isset($_GET['valor']) ? $_GET['valor'] : '';   

	

	switch ($opcao) {
		case 'Registrar': 

			//Busca as Variaveis do Formulário 
			$operadora = $_REQUEST['nOperadora']; //Busca a Operadora do Formulário 
			$sigla = $_REQUEST['nSigla']; //Busca a Sigla do Formulário 
			$observacao = $_REQUEST['nObs']; //Busca a Observação do Formulário 
			$usuario = $_REQUEST['nUsr']; //Busca o Usuário do Formulário
			$dataReg = $_REQUEST['nHora']; //Busca o Registro do Formulário  
					
			$operadoras = new Operadoras(); //Instancia um Novo Objeto da Classe Operadoras 	
			$daoOperadoras = new DaoOperadoras(); //Instancia um novo Objeto da Classe daoOperadoras

			//Busca os valores 
			$operadoras->setOperadora($operadora); 
			$operadoras->setSigla($sigla);
			$operadoras->setObservacao($observacao); 
			$operadoras->setUsuario($usuario); 
			$operadoras->setDataRegistro($dataReg);  
			

			//Teste para exibição dos valores 
			
			//echo "{$operadoras->getOperadora()}<BR>";
			//echo "{$operadoras->getSigla()}<BR>";
			//echo "{$operadoras->getObservacao()}<BR>";
			//echo "{$operadoras->getUsuario()}<BR>";
			//echo "{$operadoras->getDataRegistro()}<BR>"; 

			//echo "<BR>";

			$daoOperadoras->registrarOperadora($operadoras);  

		break; 

		case 'Editar': 
			
			$id = $_REQUEST['nCod']; //busca o Id
			$operadora = $_REQUEST['nOperadora']; //Busca a Operadora do Formulário 
			$sigla = $_REQUEST['nSigla']; //Busca a Sigla do Formulário 
			$observacao = $_REQUEST['nObs']; //Busca a Observação do Formulário 
			$usuario = $_REQUEST['nUsr']; //Busca o Usuário do Formulário
			$dataReg = $_REQUEST['nHora']; //Busca o Registro do Formulário    

			$operadoras = new Operadoras(); //Instancia um Novo Objeto da Classe Operadoras 	
			$daoOperadoras = new DaoOperadoras(); //Instancia um novo Objeto da Classe daoOperadoras

			//Busca os valores 
			$operadoras->setId($id); 
			$operadoras->setOperadora($operadora); 
			$operadoras->setSigla($sigla);
			$operadoras->setObservacao($observacao); 
			$operadoras->setUsuario($usuario); 
			$operadoras->setDataRegistro($dataReg);  

			
			//echo "{$operadoras->getId()}<BR>";
			//echo "{$operadoras->getOperadora()}<BR>";
			//echo "{$operadoras->getSigla()}<BR>";
			//echo "{$operadoras->getObservacao()}<BR>";
			//echo "{$operadoras->getUsuario()}<BR>";
			//echo "{$operadoras->getDataRegistro()}<BR><BR>"; 


			$daoOperadoras->alterarOperadora($operadoras);

		break;	

		case 'Excluir' : 

				$id = $_REQUEST['escId'];
				//echo $id." CONSEGUI TERMINAR MEU PRIMEIRO 'MVC'"; 
			
				$operadoras = new Operadoras(); //Instancia um novo objeto da Classe DaoOperadoras
				$daoOperadoras = new DaoOperadoras(); //Instancia um novo objeto da Classe DaoOperadoras

			
				$operadoras->setId($id); //Seta o ID que será utilizado 


				$daoOperadoras->excluirOperadora($id); //Chama o método que irá realizar a exclusão 
				

		break;


		case 'Visualizar': 

			$listOperadoras = new DaoOperadoras(); 
			$listOperadoras->listarOperadoras(); //instancia o listarOperadoras  
		
			//$this->load->view('../VIEWS/tabOperadoras.php', $lista);
		break;	


		case 'VisualizarID' : 	
		
			$cod = $_REQUEST['codigo']; 
			
			//echo $idd;

			$listPorId = new DaoOperadoras(); 
			$listaId = $listPorId->listarOperadoraPorId($cod);

		break;	
			
		default:
			# code...
			break;
	} 



?>