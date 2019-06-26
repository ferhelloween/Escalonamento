<?php

	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=UTF-8');

	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais  


	require_once "../MODELS/Escalonamento.php"; 
	require_once "../MODELS/DaoEscalonamento.php"; 


	$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
	$valor = isset($_GET['valor']) ? $_GET['valor'] : '';    


		switch ($opcao) {
			
			case 'Registrar':
				
				#### Resgata as Variaveis no Formulário 
				$operadora = $_REQUEST['nOperadora']; //Nome da Operadora 
				$nivel = $_REQUEST['nNivel']; //Nivel do contato 
				$contato = $_REQUEST['nContato']; //Nome do Contato 
				$funcao = $_REQUEST['nFuncao']; //Função do Contato
				$comercial = $_REQUEST['nContComercial']; //É comercial? 
				$telefone = $_REQUEST['nTelefone']; //Telefone do Contato
				$opcao = $_REQUEST['nOpcao']; //Opção do Contato
				$celular1 = $_REQUEST['nCelular1']; //Celular 1 do Contato 
				$celular2 = $_REQUEST['nCelular2']; //Celular 2 do Contato
				$email = $_REQUEST['nEmail']; //Email do Contato
				$atendimento = $_REQUEST['nAtendimento']; //Horario de Atendimento
				$escalonar = $_REQUEST['nEscalonar']; //Tempo para escalonamento
				$hc = $_REQUEST['nEscHc']; //Atendimento em Horário Comercial
				$ot = $_REQUEST['nEscOt']; //Atendimento fora do Horário comercial 
				$nivelMinimo = $_REQUEST['nNivelMinimo']; //Nivel Mínimo de Escalonamento 
				$observacao = $_REQUEST['nObservacao']; //Observações e comentários 

				$escalonamento = new Escalonamento(); //Cria o Objeto para escalonamento 
				$daoEscalonamento = new DaoEscalonamento(); //Cria o Objeto para o Dao  

				//Busca os valores 
				$escalonamento->setOperadora($operadora); //Seta o Valor para operadora 
				$escalonamento->setNivel($nivel); //Seta o Valor para o Nivel 
				$escalonamento->setContato($contato); //Seta o valor para o contato 
				$escalonamento->setFuncao($funcao); //Seta o valor para a função 
				$escalonamento->setComercial($comercial); //Seta o valor para contato comercial 
				$escalonamento->setTelefone($telefone); //Seta o valor para o telefone 
				$escalonamento->setOpcao($opcao); //Seta a opção do telefone 
				$escalonamento->setCelular1($celular1); //Seta a opção do celular 1 
				$escalonamento->setEmail($email); //Seta o e-mail do contato 
				$escalonamento->setHorario($atendimento); //Seta o Valor do horario de atendimento 
				$escalonamento->setEscalonarApos($escalonar); //Seta o valor do tempo de escalonamento 
				$escalonamento->setHc($hc); //Seta o valor para atendimento em horario comercial 
				$escalonamento->setOt($ot); //Seta o valor para atendimento fora do horario comercial   
				$escalonamento->setNme($nivelMinimo); //Seta o valor para o nível mínimo de escalonamento. 
				$escalonamento->setObservacao($observacao); //Seta o valor para observação


				//Instancia o Objeto 
				$daoEscalonamento->registrarEscalonamento($escalonamento);

			break;
			

			case 'Alterar': 
			
				#### Resgata as Variaveis no Formulário 
				$id = $_REQUEST['nCod']; //Id do Registro
				$operadora = $_REQUEST['nOperadora']; //Nome da Operadora 
				$nivel = $_REQUEST['nNivel']; //Nivel do contato 
				$contato = $_REQUEST['nContato']; //Nome do Contato 
				$funcao = $_REQUEST['nFuncao']; //Função do Contato
				$comercial = $_REQUEST['nContComercial']; //É comercial? 
				$telefone = $_REQUEST['nTelefone']; //Telefone do Contato
				$opcao = $_REQUEST['nOpcao']; //Opção do Contato
				$celular1 = $_REQUEST['nCelular1']; //Celular 1 do Contato 
				$celular2 = $_REQUEST['nCelular2']; //Celular 2 do Contato
				$email = $_REQUEST['nEmail']; //Email do Contato
				$atendimento = $_REQUEST['nAtendimento']; //Horario de Atendimento
				$escalonar = $_REQUEST['nEscalonar']; //Tempo para escalonamento
				$hc = $_REQUEST['nEscHc']; //Atendimento em Horário Comercial
				$ot = $_REQUEST['nEscOt']; //Atendimento fora do Horário comercial 
				$nivelMinimo = $_REQUEST['nNivelMinimo']; //Nivel Mínimo de Escalonamento 
				$observacao = $_REQUEST['nObservacao']; //Observações e comentários 
				$usr_alt = $_REQUEST['nUsr']; //Usuário que irá fazer a alteração

				//echo "Atendimento: ".$atendimento."<BR>";

				$escalonamento = new Escalonamento(); //Cria o Objeto para escalonamento 
				$daoEscalonamento = new DaoEscalonamento(); //Cria o Objeto para o Dao  


				//Busca os valores 
				$escalonamento->setId($id); //Seta o ID do Registro
				$escalonamento->setOperadora($operadora); //Seta o Valor para operadora 
				$escalonamento->setNivel($nivel); //Seta o Valor para o Nivel 
				$escalonamento->setContato($contato); //Seta o valor para o contato 
				$escalonamento->setFuncao($funcao); //Seta o valor para a função 
				$escalonamento->setComercial($comercial); //Seta o valor para contato comercial 
				$escalonamento->setTelefone($telefone); //Seta o valor para o telefone 
				$escalonamento->setOpcao($opcao); //Seta a opção do telefone 
				$escalonamento->setCelular1($celular1); //Seta a opção do celular 1 
				$escalonamento->setEmail($email); //Seta o e-mail do contato 
				$escalonamento->setHorario($atendimento); //Seta o Valor do horario de atendimento 
				$escalonamento->setEscalonarApos($escalonar); //Seta o valor do tempo de escalonamento 
				$escalonamento->setHc($hc); //Seta o valor para atendimento em horario comercial 
				$escalonamento->setOt($ot); //Seta o valor para atendimento fora do horario comercial   
				$escalonamento->setNme($nivelMinimo); //Seta o valor para o nível mínimo de escalonamento. 
				$escalonamento->setObservacao($observacao); //Seta o valor para observação 

				//echo "HORARIO:".$escalonamento->getHorario()."<BR>";


				//Instancia o Objeto
				$daoEscalonamento->alteraEscalonamento($escalonamento); 					


			break; 


			case 'Excluir': 

				$excEscalonamento = new Escalonamento();
				$consultaEscalonamento = new DaoEscalonamento();

				$id = $_REQUEST['escId']; 
				//echo  $id."<BR>";

				$consultaEscalonamento->consultaDocumentoExclusao($id); //Joga o Registro para a base histórica 
				$consultaEscalonamento->excluirEscalonamento($id); //Exclui o Registro. 


			break;

			case 'Visualizar': 
				$listEscalonamento = new DaoEscalonamento(); 
				$listEscalonamento->listarEscalonamento();

			break;

			case 'VisualizarN': 
				$listEscalonamentoN = new DaoEscalonamento(); 
				$listEscalonamentoN->listarEscalonamentoN();

			break;



			case 'Listar':
				$listOperadora = new DaoEscalonamento(); 
				$listOperadora->alimentaOperadoras(); 	
		
			break; 



			case 'Historico':
			
				$historico = new DaoEscalonamento();
				$historico->listarHistorico();

			break;


			default:
				################ Default Vazio 
			break;
		}




?> 