<?php 

	
	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento  


	include_once "Conexao.php"; 
	include_once "Rh.php"; 

	class daoRh
	{
		
		public function registrarRh(Rh $rh) { 
				
			//Chama os nomes que serão usados para inserir o registro 	
			$matricula = $rh->getMatricula(); 
			$nome = $rh->getNome(); 
			$empresa = $rh->getEmpresa(); 
			$funcao = $rh->getFuncao(); 
			$grupoGsc = $rh->getGrupoGsc(); 
			$ramal = $rh->getRamal(); 
			$celular = $rh->getCelular(); 


			abreConexao(); //Abre a Conexão com o banco de Dados 
			global $sql; //Variavel global que será responsável por executar a conexão 


			//Cria a variavel para insert 
			$queryInsert = "
				INSERT INTO [dbo].[tb_rh_cgr] ([empresa],[matricula],[nome]
        		   ,[ramal],[cel],[grupo_gsc],[funcao]) VALUES (";
        	$queryInsert .= "'".$empresa."',";
        	$queryInsert .= "'".$matricula."',";
        	$queryInsert .= "'".$nome."',";
        	$queryInsert .= "'".$ramal."',";
        	$queryInsert .= "'".$celular."',";
        	$queryInsert .= "'".$grupo_gsc."',";
        	$queryInsert .= "'".$funcao."')";	   


			//Executa o try catch 
			try {

				$resultInsert = $sql->prepare($queryInsert); //Prepara a Consulta 
				$resultInsert->execute();  //Executa a Consulta 

				//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						Efetuado registro com sucesso!	
					</p>	
				
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/formRhCgr.php'>Clique aqui para efetuar um novo registro</a>
					</p>

					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
					</p>
				"; 

				echo $sucesso; 

			} catch (Exception $e) {
				print "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>"; 
			}

			fechaConexao(); //Fecha a Conexão com o banco 	


		}

		public function alterarRh(Rh $rh) { 

			//Chama os nomes que serão usados para inserir o registro 	
			$id = $rh->getId(); 
			$matricula = $rh->getMatricula(); 
			$nome = $rh->getNome(); 
			$empresa = $rh->getEmpresa(); 
			$funcao = $rh->getFuncao(); 
			$grupoGsc = $rh->getGrupoGsc(); 
			$ramal = $rh->getRamal(); 
			$celular = $rh->getCelular(); 
			$userAlt = $rh->getUserAlt(); 

			abreConexao(); //Abre a conexão com o banco de dados 
			global $sql; //Variavel global que será responsável por executar a conexão. 


			//Cria o comando de UPDATE para atualizar o banco 
			$queryUpdate = "UPDATE [dbo].[tb_rh_cgr] SET";
			$queryUpdate .= "[matricula] = '".$matricula."',";
			$queryUpdate .= "[nome] = '".$nome."',";
			$queryUpdate .= "[empresa] = '".$empresa."',";
			$queryUpdate .= "[funcao] = '".$funcao."',";
			$queryUpdate .= "[grupo_gsc] = '".$grupoGsc."',";
			$queryUpdate .= "[ramal] = '".$ramal."',";
			$queryUpdate .= "[cel] = '".$cel."',";
			$queryUpdate .= "[usr_alt] = '".$usr_alt."'";
			$queryUpdate .=	 " WHERE [id] = ".$id;  


			//echo $queryUpdate."<BR>";

			//Cria o Bloco Try Catch para executar a consulta 
			try {

						//Executa a query 
					$resUpdate = $sql->prepare($queryUpdate); //Prepara a atualização
					$resUpdate->execute(); //Executa a atualização  

						//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
					$sucesso = "<BR>
							<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
								Alterado registro com sucesso!	
							</p>	
							
							<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
								<a href='../VIEWS/formAlteraRh.php?id=$id'>Clique aqui para retornar a tela do Registro</a>
							</p>
					"; 

					echo $sucesso; 
	
					
				} catch (Exception $e) {
					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>";
				}

			fechaConexao();	 //Fecha a Conexão com o banco 	

		}


		public function excluirRh($id) { 

			abreConexao(); //Abre a Conexão com o Banco de Dados 
			global $sql; //Varíavel global  


				//Cria a query para delete 
			$queryDelete = "
				DELETE FROM [dbo].[tb_rh_cgr] WHERE [id] = '$id'
			";

			try {

					$result = $sql->prepare($queryDelete); //Prepara a consulta 
					$result->execute(); //Executa a consulta

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
					$sucesso = "<BR>
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						Registro Excluido com Sucesso!!!	
					</p>	
						
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
					</p>
					"; 

					echo $sucesso; 




				} catch (Exception $e) {
					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>";
				}

			fechaConexao();	


		}

		public function listarRh() { 

			abreConexao(); //Abre a Conexão com o Banco de Dados 
			global $sql; //Varíavel global  


			$listaRh = []; 

			$querySelect = "
				SELECT [id] as cod,[empresa],[matricula],[nome]
      			,[ramal],[cel],[grupo_gsc],[usr_alt],[funcao]
  				FROM [Inventario].[dbo].[tb_rh_cgr]
			";	


			//Cria o Bloco Try Catch 
			try {
				$stmt = $sql->prepare($querySelect); //Prepara a Consulta 
				$stmt->execute(); //Executa a consulta

					foreach ($stmt as $value) {
						$cod = $value['cod']; 
						$empresa =  $value["empresa"]; 
						$matricula = $value["matricula"];
						$nome =  $value["nome"];
						$ramal = $value["ramal"];
						$cel = $value["cel"];
						$grupo_gsc = $value["grupo_gsc"];
						$usr_alt =  $value["usr_alt"];
						$funcao =  $value["funcao"];

						$listaRh[] = array(
							"cod" => $cod, 
							"empresa" => $empresa, 
							"matricula" => $matricula, 
							"nome" => $nome, 
							"ramal" => $ramal, 
							"cel" => $cel, 
							"grupo_gsc" => $grupo_gsc, 
							"usr_alt" => $usr_alt, 
							"funcao" => $funcao	

						); 							

					}

				echo json_encode($listaRh,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR); 	

			} catch (Exception $e) {
				print "Ocorreu um erro: <b style='color: red;>".$e->getMessage()."</b>";
			}

			fechaConexao(); //Fecha a Conexão com o Banco de Dados 


		}


		public function consultaDocumentoExclusao($id) { 

				$consultaExclusao = "
				SELECT [id],[empresa],[matricula],[nome]
      			,[ramal],[cel],[grupo_gsc],[usr_alt],[funcao]
  				FROM [Inventario].[dbo].[tb_rh_cgr] WHERE [id]=$id"; 

  				//echo $consultaExclusao;

  				try {
  				
  					abreConexao(); //Abre a conexão com o banco de dados 
					global $sql; //variavel global para executar a conexão


					$result = $sql->prepare($consultaExclusao); //Prepara a Consulta 
					$result->execute(); 

					$lista = $result->fetch(PDO::FETCH_ASSOC); 

					//Atribui os Campos 
					$id = $lista['id']; 
					$empresa = $lista["empresa"]; 
					$matricula = $lista["matricula"];
					$nome =  $lista["nome"];
					$ramal =  $lista["ramal"];
					$cel =  $lista["cel"];
					$grupo_gsc =  $lista["grupo_gsc"];
					$usr_alt =  $lista["usr_alt"];
					$funcao =  $lista["funcao"]; 

					fechaConexao(); //Fecha a Primeira conexão 

					//Reabre a Conexão 
					abreConexao(); //Abre a conexão com o banco de dados 
					global $sql; //variavel global para executar a conexão


					$userExc = strtolower($_SERVER["REMOTE_USER"]);
					$userExc = split('\\\\',$userExc); 
					$userExc = $userExc[1];

					//echo $userExc."<BR>";  

					$dataExclusao = date('d-m-Y H:m:s');  
		
					$insereRhExc = "INSERT INTO [dbo].[tb_rh_cgr_hist]
        		   ([empresa],[matricula],[nome],[ramal],[cel],[grupo_gsc]
           			,[usr_alt],[funcao],[exc_por],[data_desligamento]) VALUES ( ";
           			$insereRhExc .= "'".$empresa."',";
           			$insereRhExc .= "'".$matricula."',";
           			$insereRhExc .= "'".$nome."',";
           			$insereRhExc .= "'".$ramal."',";
           			$insereRhExc .= "'".$cel."',";
           			$insereRhExc .= "'".$grupo_gsc."',";
           			$insereRhExc .= "'".$usr_alt."',";
           			$insereRhExc .= "'".$funcao."',";
           			$insereRhExc .= "'".$exc_por."',";
           			$insereRhExc .= "'".$data_desligamento."')"; 

					//echo $insereRhExc;


					//echo $insereEscalonamentoExc;
					$resultInsExc  = $sql->prepare($insereRhExc); 
					$resultInsExc->execute(); //Executa a consulta


					fechaConexao(); 



  				} catch (Exception $e) {
  					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";

  				}


		} 

		public function listarHistorico() { 

			try {
				

				abreConexao(); 
				global $sql; 


				$queryHistorico = "
					SELECT [id] as cod,[empresa],[matricula],[nome],[ramal],[cel]
	   			   ,[grupo_gsc] as gsc,[usr_alt] as usrAlt,[funcao],[exc_por] as excPor,[data_desligamento] as desligamento
	 				 FROM [Inventario].[dbo].[tb_rh_cgr_hist]
				"; 


				$result = $sql->prepare($queryHistorico); //Prepara a consulta 
				$result->execute(); //Executa a consulta 

				$lista = $result->fetchall(PDO::FETCH_ASSOC); //Lista os itens da tabela 

				echo json_encode($lista,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR);  

				fechaConexao(); 


			} catch (Exception $e) {
				print "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";		
			}


		}


	}




?> 	