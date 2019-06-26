<?php 


		########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=UTF-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais  


	require_once "../MODELS/Fornecedores.php"; 
	require_once "../MODELS/DaoFornecedores.php"; 

	$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
	$valor = isset($_GET['valor']) ? $_GET['valor'] : '';


		switch ($opcao) {
			case 'Registrar':

				##############Resgadta as variaveis no Formulário 
				$empresa = $_REQUEST['nEmpresa']; 
				$contato = $_REQUEST['nContato']; 
				$funcao = $_REQUEST['nFuncao']; 
				$contatComercial = $_REQUEST['nContComercial']; 
				$telefone = $_REQUEST['nTelefone']; 
				$celular1 = $_REQUEST['nCelular1']; 
				$celular2 = $_REQUEST['nCelular2']; 
				$email = $_REQUEST['nEmail']; 
				$ativo = $_REQUEST['nAtivo']; 
				$fabricante = $_REQUEST['nFabricante']; 
				$modelo = $_REQUEST['nModelo']; 
				$host = $_REQUEST['nHost']; 
				$localidade = $_REQUEST['nLocalidade']; 
				$servico = $_REQUEST['nServico']; 
				$nivelEscalonamento = $_REQUEST['nNivel']; 
				$observacao = $_REQUEST['nObservacao']; 

				$fornecedores = new Fornecedores(); //Cria um novo objeto da classe de Fornecedores 
				$daoFornecedores = new DaoFornecedores(); //Cria um novo objeto para a classe DaoFornecedores	

				//Busca os valores 
				$fornecedores->setEmpresa($empresa); 
				$fornecedores->setContato($contato); 
				$fornecedores->setContatoComercial($contatComercial); 
				$fornecedores->setFuncao($funcao); 
				$fornecedores->setTelefone($telefone); 
				$fornecedores->setCelular1($celular1); 
				$fornecedores->setCelular2($celular2); 
				$fornecedores->setEmail($email); 
				$fornecedores->setAtivo($ativo); 
				$fornecedores->setFabricante($fabricante); 
				$fornecedores->setModelo($modelo); 
				$fornecedores->setHost($host); 
				$fornecedores->setLocalidade($localidade); 
				$fornecedores->setServico($servico); 
				$fornecedores->setNivelMinimo($nivelEscalonamento); 
				$fornecedores->setObservacao($observacao); 


				$daoFornecedores->registrarFornecedores($fornecedores); //Registra o fornecedor no Banco de Dados 

				
				break;

			case 'Alterar': 

				##############Resgata as variaveis no Formulário 
				$id = $_REQUEST['nCod'];
				$empresa = $_REQUEST['nEmpresa']; 
				$contato = $_REQUEST['nContato']; 
				$funcao = $_REQUEST['nFuncao']; 
				$contatComercial = $_REQUEST['nContComercial']; 
				$telefone = $_REQUEST['nTelefone']; 
				$celular1 = $_REQUEST['nCelular1']; 
				$celular2 = $_REQUEST['nCelular2']; 
				$email = $_REQUEST['nEmail']; 
				$ativo = $_REQUEST['nAtivo']; 
				$fabricante = $_REQUEST['nFabricante']; 
				$modelo = $_REQUEST['nModelo']; 
				$host = $_REQUEST['nHost']; 
				$localidade = $_REQUEST['nLocalidade']; 
				$servico = $_REQUEST['nServico']; 
				$nivelEscalonamento = $_REQUEST['nNivel']; 
				$observacao = $_REQUEST['nObservacao']; 
				$user_alt = $_REQUEST['nUsr']; 
				//$hora = $_REQUEST['nHora'];

				$fornecedores = new Fornecedores(); //Cria um novo objeto da classe de Fornecedores 
				$daoFornecedores = new DaoFornecedores(); //Cria um novo objeto para a classe DaoFornecedores	 

				//Busca os valores 
				$fornecedores->setId($id);
				$fornecedores->setEmpresa($empresa); 
				$fornecedores->setContato($contato); 
				$fornecedores->setContatoComercial($contatComercial); 
				$fornecedores->setFuncao($funcao); 
				$fornecedores->setTelefone($telefone); 
				$fornecedores->setCelular1($celular1); 
				$fornecedores->setCelular2($celular2); 
				$fornecedores->setEmail($email); 
				$fornecedores->setAtivo($ativo); 
				$fornecedores->setFabricante($fabricante); 
				$fornecedores->setModelo($modelo); 
				$fornecedores->setHost($host); 
				$fornecedores->setLocalidade($localidade); 
				$fornecedores->setServico($servico); 
				$fornecedores->setNivelMinimo($nivelEscalonamento); 
				$fornecedores->setObservacao($observacao); 
				$fornecedores->setUserAlt($user_alt); 

				$daoFornecedores->alterarFornecedores($fornecedores); //Registra o fornecedor no Banco de Dados 


				break; 

			case 'Excluir': 

				$fornecedores = new Fornecedores();	
				$daoFornecedores = new DaoFornecedores(); 

				$id = $_REQUEST['escId']; 
				//echo $id;
		
				$daoFornecedores->consultaDocumentoExclusao($id); //Passa o Arquivo para a tabela histórica 
				$daoFornecedores->excluirFornecedores($id); //Exclui o fornecedor			


				break;		
			
			case 'Visualizar':

				$listFornecedores = new DaoFornecedores(); 
				$listFornecedores->listarFornecedores();
				
				break;	


			case 'Historico':

				$listFornecedores = new DaoFornecedores(); 
				$listFornecedores->listarHistorico();
				
			break;	



			default:
				# code...
				break;
		}




?> 