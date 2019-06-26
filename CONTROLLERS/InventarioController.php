<?php

	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=UTF-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais  


	require_once "../MODELS/Inventario.php"; 
	require_once "../MODELS/DaoInventario.php"; 


	$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
	$valor = isset($_GET['valor']) ? $_GET['valor'] : '';  


	switch ($opcao) {
		case 'Registrar':
			
			##################### Resgata as Variáveis no formulário 
			$tipo = $_REQUEST['nTipo']; 
			$patrimonio = $_REQUEST['nPatrimonio']; 
			$numSerie = $_REQUEST['nSerie']; 
			$empresa = $_REQUEST['nEmpresa'];
			$marca = $_REQUEST['nMarca']; 
			$usuario = $_REQUEST['nUsuario']; 
			$telefone = $_REQUEST['nTelefone']; 
			$ponto = $_REQUEST['nPonto']; 
			$hostname = $_REQUEST['nHostname']; 
			$software = $_REQUEST['nSoftware']; 
			$observacao = $_REQUEST['nObservacao']; 

			$inventario = new Inventario(); //Cria um objeto para inventario 
			$daoInventario = new DaoInventario(); //Cria o objeto para o Dao

			//Busca os valores 
			$inventario->setTipo($tipo); //Seta o valor para TIPO de Item 
			$inventario->setPatrimonio($patrimonio); //Seta o valor para o patrimônio 
			$inventario->setNumSerie($numSerie); //Seta o valor para o número de série 
			$inventario->setEmpresa($empresa); //Seta o valor para a empresa
			$inventario->setMarca($marca); //Seta o valor para a marca
			$inventario->setUsuario($usuario); //Seta o valor do usuário 
			$inventario->setTelefone($telefone); //Seta o valor do telefone 
			$inventario->setPonto($ponto); //Seta o valor do ponto 
			$inventario->setHostname($hostname); //Seta o valor do hostname
			$inventario->setSoftware($software); //Seta o valor do software 
			$inventario->setObservacao($observacao); //Seta o valor para observação 

			//Instancia o objeto 
			$daoInventario->registrarInventario($inventario); 

			break;
			//Fim do Processo de Registrar


		case 'Alterar':
			
			##################### Resgata as Variáveis no formulário 
			$id = $_REQUEST['nCod']; //Id do Registro
			$tipo = $_REQUEST['nTipo']; 
			$patrimonio = $_REQUEST['nPatrimonio']; 
			$numSerie = $_REQUEST['nSerie']; 
			$empresa = $_REQUEST['nEmpresa'];
			$marca = $_REQUEST['nMarca']; 
			$usuario = $_REQUEST['nUsuario']; 
			$telefone = $_REQUEST['nTelefone']; 
			$ponto = $_REQUEST['nPonto']; 
			$hostname = $_REQUEST['nHostname']; 
			$software = $_REQUEST['nSoftware']; 
			$observacao = $_REQUEST['nObservacao']; 
			$usr_alt = $_REQUEST['nUsr']; //Usuário que irá fazer a alteração


			$inventario = new Inventario(); //Cria um objeto para inventario 
			$daoInventario = new DaoInventario(); //Cria o objeto para o Dao



			//Busca os valores 
			$inventario->setId($id); //Seta o ID do Registro
			$inventario->setTipo($tipo); //Seta o valor para TIPO de Item 
			$inventario->setPatrimonio($patrimonio); //Seta o valor para o patrimônio 
			$inventario->setNumSerie($numSerie); //Seta o valor para o número de série 
			$inventario->setEmpresa($empresa); //Seta o valor para a empresa
			$inventario->setMarca($marca); //Seta o valor para a marca
			$inventario->setUsuario($usuario); //Seta o valor do usuário 
			$inventario->setTelefone($telefone); //Seta o valor do telefone 
			$inventario->setPonto($ponto); //Seta o valor do ponto 
			$inventario->setHostname($hostname); //Seta o valor do hostname
			$inventario->setSoftware($software); //Seta o valor do software 
			$inventario->setObservacao($observacao); //Seta o valor para observação 
			$inventario->setUsrAlt($usrAlt); //Seta o valor para usuário que efetuou a alteração

			$daoInventario->alterarInventario($inventario); 

			break;
			//Fim do Processo de Registrar
		
		case 'Excluir':
			
			$excInventario = new DaoInventario(); //Cria o objeto para exclusão 

			$id = $_REQUEST['escId']; 

			$excInventario->excluirInventario($id); //Exclui o registro


			break;
			//Fim do Processo de Registrar

		case 'Visualizar':
			
			$listInventario = new DaoInventario(); //Cria o objeto 
			$listInventario->listarInventario(); //Lista os inventarios


			break;
		
		default:
			# code...
			break;
	}



?>