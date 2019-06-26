<?php 

	
	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento  


	include_once "../MODELS/Rh.php";
	include_once "../MODELS/daoRh.php"; 


	$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
	$valor = isset($_GET['valor']) ? $_GET['valor'] : '';


	switch ($opcao) {
	 	case 'Registrar':
 		
	 		##################### Resgata os dados do formulário 
	 		$funcionario = $_REQUEST['nFuncionario']; 
	 		$matricula = $_REQUEST['nMatricula']; 
	 		$empresa = $_REQUEST['nEmpresa']; 
	 		$funcao = $_REQUEST['nFuncao'];
	 		$ramal = $_REQUEST['nTelefone'];  
	 		$celular = $_REQUEST['nCelular']; 
	 		$gsc = $_REQUEST['nGsc']; 

	 		$rh = new Rh(); //Cria um novo objeto para a classe RH 
	 		$daoRh = new daoRh(); //Cria um novo objeto par a classe daoRh 

	 		//Seta os Valores 
	 		$rh->setNome($funcionario); 
	 		$rh->setMatricula($matricula); 
	 		$rh->setEmpresa($empresa); 
	 		$rh->setFuncao($funcao); 
	 		$rh->setRamal($ramal); 
	 		$rh->setCelular($celular); 
	 		$rh->setGrupoGsc($gcs); 

	 		$daoRh->registrarRh($rh); //Registra o contato no banco de dados 

	 		break; 

	 	case 'Alterar':


	 		##################### Resgata os dados do formulário  
	 		$id = $_REQUEST['nCod'];
	 		$funcionario = $_REQUEST['nFuncionario']; 
	 		$matricula = $_REQUEST['nMatricula']; 
	 		$empresa = $_REQUEST['nEmpresa']; 
	 		$funcao = $_REQUEST['nFuncao'];
	 		$ramal = $_REQUEST['nTelefone'];  
	 		$celular = $_REQUEST['nCelular']; 
	 		$grupoGsc = $_REQUEST['nGsc']; 
	 		$user_alt = $_REQUEST['nUsr']; 

	 		//echo $gsc."<BR>";

	 		$rh = new Rh(); //Cria um novo objeto para a classe RH 
	 		$daoRh = new daoRh(); //Cria um novo objeto par a classe daoRh 

	 		//Seta os Valores 
	 		$rh->setId($id); 
	 		$rh->setNome($funcionario); 
	 		$rh->setMatricula($matricula); 
	 		$rh->setEmpresa($empresa); 
	 		$rh->setFuncao($funcao); 
	 		$rh->setRamal($ramal); 
	 		$rh->setCelular($celular); 
	 		$rh->setGrupoGsc($grupoGsc); 
	 		$rh->setUserAlt($user_alt);

	 		$daoRh->alterarRh($rh); //Registra o contato no banco de dados 

	 		break;	

	 	case 'Excluir':
	 		
	 		$rh = new Rh(); //Cria um novo objeto para a classe RH 
	 		$daoRh = new daoRh(); //Cria um novo objeto par a classe daoRh 

	 		$id = $_REQUEST['escId']; 

	 		$daoRh->consultaDocumentoExclusao($id); //Executa jogando o contato para a base histórica 
	 		$daoRh->excluirRh($id); // Exclui o Registro


	 		break;	
	
	 	case 'Visualizar':
	 		
	 		$listaRh = new daoRh(); 
	 		$listaRh->listarRh(); 	


	 		break;	
	
	 	case 'HistoricoRh': 
	 	
	 		$listaHistorico = new daoRh(); 
	 		$listaHistorico->listarHistorico();	

	 		break;

	 	default:
	 		# code...
	 		break;
	 } 