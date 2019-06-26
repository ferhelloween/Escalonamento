<?php 

	
		########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=UTF-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais  	 


	require_once "../MODELS/EscalonamentoCaixa.php"; 
	require_once "../MODELS/DaoEscalonamentoCaixa.php"; 


	$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
	$valor = isset($_GET['valor']) ? $_GET['valor'] : ''; 

		switch ($opcao) {
			case 'Registrar':
				
				###################Resgata as Variaveis do Formulário 
				$nome = $_REQUEST['nFuncionario']; 
				$matricula = $_REQUEST['nMatricula']; 
				$area = $_REQUEST['nArea']; 
				$equipe = $_REQUEST['nEquipe']; 
				$funcao = $_REQUEST['nFuncao']; 
				$telefone = $_REQUEST['nTelefone']; 
				$celular1 = $_REQUEST['nCelular1']; 
				$celular2 = $_REQUEST['nCelular2']; 
				$hc = $_REQUEST['nEscHc']; 
				$ot = $_REQUEST['nEscOt']; 
				$fds = $_REQUEST['nEscFs']; 
				$mad = $_REQUEST['nEscMa']; 
				$plantao = $_REQUEST['nPlantao']; 
				$nivMin = $_REQUEST['nNivel']; 
				$observacao = $_REQUEST['nObservacao']; 

					
				
				$escalonamentoCaixa = new EscalonamentoCaixa(); //Cria um novo objeto da classe de escalonamentoCaixa 
				$daoEscalonamentoCaixa = new DaoEscalonamentoCaixa(); //Cria um novo objeto para a classe DaoEscalonamentoCaixa 

				//Busca os valores
				$escalonamentoCaixa->setNome($nome); 
				$escalonamentoCaixa->setMatricula($matricula); 
				$escalonamentoCaixa->setArea($area); 
				$escalonamentoCaixa->setEquipe($equipe); 
				$escalonamentoCaixa->setFuncao($funcao); 
				$escalonamentoCaixa->setTelefone($telefone); 
				$escalonamentoCaixa->setCelular1($celular1); 
				$escalonamentoCaixa->setCelular2($celular2); 
				$escalonamentoCaixa->setHc($hc); 
				$escalonamentoCaixa->setOt($ot); 
				$escalonamentoCaixa->setFds($fds);
				$escalonamentoCaixa->setMad($mad); 
				$escalonamentoCaixa->setPlantao($plantao); 
				$escalonamentoCaixa->setNivMin($nivMin); 
				$escalonamentoCaixa->setObservacao($observacao); 
				 
				 
				$daoEscalonamentoCaixa->registrarEscalonamentoCaixa($escalonamentoCaixa); //Registra o contato no banco de dados

				break;
			
			case 'Alterar':
				
				##############Resgata as variaveis no Formulário 
				$id = $_REQUEST['nCod'];
				$nome = $_REQUEST['nFuncionario']; 
				$matricula = $_REQUEST['nMatricula']; 
				$area = $_REQUEST['nArea']; 
				$equipe = $_REQUEST['nEquipe']; 
				$funcao = $_REQUEST['nFuncao']; 
				$telefone = $_REQUEST['nTelefone']; 
				$celular1 = $_REQUEST['nCelular1']; 
				$celular2 = $_REQUEST['nCelular2']; 
				$hc = $_REQUEST['nEscHc']; 
				$ot = $_REQUEST['nEscOt']; 
				$fds = $_REQUEST['nEscFs']; 
				$mad = $_REQUEST['nEscMa']; 
				$plantao = $_REQUEST['nPlantao']; 
				$nivMin = $_REQUEST['nNivel']; 
				$observacao = $_REQUEST['nObservacao']; 
				$user_alt = $_REQUEST['nUsr'];


				


				$escalonamentoCaixa = new EscalonamentoCaixa(); //Cria um novo objeto da classe de escalonamentoCaixa 
				$daoEscalonamentoCaixa = new DaoEscalonamentoCaixa(); //Cria um novo objeto para a classe DaoEscalonamentoCaixa 


				//Busca os valores
				$escalonamentoCaixa->setId($id);
				$escalonamentoCaixa->setNome($nome); 
				$escalonamentoCaixa->setMatricula($matricula); 
				$escalonamentoCaixa->setArea($area); 
				$escalonamentoCaixa->setEquipe($equipe); 
				$escalonamentoCaixa->setFuncao($funcao); 
				$escalonamentoCaixa->setTelefone($telefone); 
				$escalonamentoCaixa->setCelular1($celular1); 
				$escalonamentoCaixa->setCelular2($celular2); 
				$escalonamentoCaixa->setHc($hc); 
				$escalonamentoCaixa->setOt($ot); 
				$escalonamentoCaixa->setFds($fds);
				$escalonamentoCaixa->setMad($mad); 
				$escalonamentoCaixa->setPlantao($plantao); 
				$escalonamentoCaixa->setNivMin($nivMin); 
				$escalonamentoCaixa->setObservacao($observacao);	
				$escalonamentoCaixa->setUserAlt($user_alt); 

				$daoEscalonamentoCaixa->alterarEscalonamentoCaixa($escalonamentoCaixa); //Altera o contato no banco de dados 


				break;
			
			case 'Excluir':
			
				
				$escalonamentoCaixa = new EscalonamentoCaixa(); 
				$daoEscalonamentoCaixa = new DaoEscalonamentoCaixa(); 

				$id = $_REQUEST['escId']; 

				$daoEscalonamentoCaixa->consultaDocumentoExclusao($id); 
				$daoEscalonamentoCaixa->excluirEscalonamentoCaixa($id); 




				break;
			
			case 'Visualizar':
				
				$listEscalonamentoCaixa = new DaoEscalonamentoCaixa(); 
				$listEscalonamentoCaixa->listarEscalonamentoCaixa();

				break; 

			case 'Historico': 
			
				$listaHistorico = new DaoEscalonamentoCaixa();	
				$listaHistorico->listarHistorico(); 

				break;	

			default:
				# code...
				break;
		}



?> 