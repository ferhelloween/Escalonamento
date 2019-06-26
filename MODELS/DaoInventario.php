<?php 

	########### CABEÇALHO PHP #####################	
	setlocale(LC_ALL,"pt_BR"); 
	header('Content-type: text/html; charset=utf-8');


	set_time_limit(1200); //Define tempo limite de execução
	ERROR_REPORTING (E_ERROR);  //Somente exibe erros fatais
	
	#Varíaveis globais que serão usadas para cadastramento  
	include_once "Conexao.php";
	include_once "Inventario.php";


	/**
	* 
	*/
	class DaoInventario
	{
		
		public function registrarInventario(Inventario $inventario) { 

				//Chama os métodos get na classe inventario 
				$tipo = $inventario->getTipo(); 
				$patrimonio = $inventario->getPatrimonio(); 
				$numSerie = $inventario->getNumSerie(); 
				$empresa = $inventario->getEmpresa(); 
				$marca = $inventario->getMarca(); 
				$usuario = $inventario->getUsuario(); 
				$telefone = $inventario->getTelefone(); 
				$ponto = $inventario->getPonto(); 
				$hostname = $inventario->getHostname();
				$software = $inventario->getSoftware(); 
				$observacao = $inventario->getObservacao(); 

				


				try {

					abreConexao(); //Abre a Conexão com o banco de Dados 
					global $sql; //Variável Global para utilizar na Conexão	
					
					//Cria a query que irá realizar o Insert
					$queryInsert = " INSERT INTO [dbo].[Tb_inv_CGR] ([tipo],[empresa]
			          ,[marca],[num_serie],[patrimonio],[usuario],[fone],[pont_log]
           			  ,[hostname],[software],[obs1]) VALUES( ";
           			$queryInsert .= "'".$tipo."',";
           			$queryInsert .= "'".$empresa."',";
           			$queryInsert .= "'".$marca."',";
           			$queryInsert .= "'".$numSerie."',";
           			$queryInsert .= "'".$patrimonio."',";
           			$queryInsert .= "'".$usuario."',";
           			$queryInsert .= "'".$telefone."',";
           			$queryInsert .= "'".$ponto."',";
           			$queryInsert .= "'".$hostname."',";
           			$queryInsert .= "'".$software."',";  
           			$queryInsert .= "'".$observacao."')"; 

					$resultInsert = $sql->prepare($queryInsert); //Prepara a Conexão 
					$resultInsert->execute(); //Executa o Insert 

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
					$sucesso = "<BR>
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						Efetuado registro com sucesso!	
					</p>	
					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/formInventario.php'>Clique aqui para efetuar um novo registro</a>
					</p>

					<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
						<a href='../VIEWS/inicial.php'>Clique aqui para retornar a tela principal</a>
					</p>
				"; 

					echo $sucesso; 
           		

           			fechaConexao(); //Fecha a Conexão com o banco de Dados		

				} catch (Exception $e) {
					print "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";
				}


		}

		public function alterarInventario(Inventario $inventario) { 
			//Busca o Id para alterar o registro correto 
			$id = $inventario->getId();

			//Chama os métodos get na classe inventario 
			$tipo = $inventario->getTipo(); 
			$patrimonio = $inventario->getPatrimonio(); 
			$numSerie = $inventario->getNumSerie(); 
			$empresa = $inventario->getEmpresa(); 
			$marca = $inventario->getMarca(); 
			$usuario = $inventario->getUsuario(); 
			$telefone = $inventario->getTelefone(); 
			$ponto = $inventario->getPonto(); 
			$hostname = $inventario->getHostname();
			$software = $inventario->getSoftware(); 
			$observacao = $inventario->getObservacao(); 
			$usrAlt = $inventario->getUsrAlt(); 


			//Cria o Bloco Try-Catch 
			try {

				abreConexao(); //Abre a Conexão com o banco de Dados 
				global $sql; //Variável Global para utilizar na Conexão	
			
				$queryUpdate = "UPDATE [dbo].[Tb_inv_CGR] SET"; 
				$queryUpdate .= "[tipo] = '".$tipo."',";
				$queryUpdate .= "[empresa] = '".$empresa."',";
				$queryUpdate .= "[marca] = '".$marca."',";
				$queryUpdate .= "[num_serie] = '".$numSerie."',";
				$queryUpdate .= "[patrimonio] = '".$patrimonio."',";
				$queryUpdate .= "[usuario] = '".$usuario."',";
				$queryUpdate .= "[fone] = '".$telefone."',";
				$queryUpdate .= "[pont_log] = '".$ponto."',";
				$queryUpdate .= "[hostname] = '".$hostname."',";
				$queryUpdate .= "[software] = '".$software."',";
				$queryUpdate .= "[obs1] = '".$observacao."'";
				$queryUpdate .= "[user_alt] = '".$usrAlt."',";
				$queryUpdate .= "WHERE ID = '".$id."'";


				//echo $queryUpdate."<BR>";

				$resultUpdate = $sql->prepare($queryUpdate); //Prepara a Consulta 
				$resultUpdate->execute(); //Executa a Consulta  

					//Cria uma variavel de Sucesso em caso de Cadastro Correto. 
				$sucesso = "<BR>
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							Alterado registro com sucesso!	
						</p>	
						
						<p style='margin-left: 15px; font-family: Arial, Helvetica, sans-serif; color: #066fa8'>
							<a href='../VIEWS/formAlteraInventario.php?id=$id'>Clique aqui para retornar a tela do Registro</a>
						</p>
				"; 

				echo $sucesso;  

				fechaConexao();

			} catch (Exception $e) {
				print "Ocorreu um erro: <b style='color: red;>".$e->getMessage."</b>";
			}






		}


		public function excluirInventario($id) { 
		

			try {

				abreConexao(); //Abre a conexão com o banco de dados 
				global $sql; //variavel global para executar a conexão  
				
				$queryDelete = "
					DELETE FROM [dbo].[Tb_inv_CGR] WHERE [id] = '$id'
				"; 	

				$resDelete = $sql->prepare($queryDelete); 
				$resDelete->execute(); 

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

				fechaConexao();

			} catch (Exception $e) {
				print "Ocorreu um erro: <b style='color: red;>".$e3->getMessage."</b>"; 	
			}	

		

		}


		public function listarInventario() { 

				try {


					abreConexao(); //Abre a conexão com o banco de dados 
					global $sql; //variavel global para executar a conexão  
					
					$querySelect = "
						SELECT [id] as cod ,[tipo] ,[empresa] ,[marca]
 					    ,[num_serie] ,[patrimonio] ,[usuario] ,[fone]
      					,[pont_log]  ,[hostname] as hostX   ,[software] ,[obs1]
      					,[user_alt]  FROM [Inventario].[dbo].[Tb_inv_CGR]";

      					$resSelect = $sql->prepare($querySelect); //Prepara a consulta 
						$resSelect->execute(); 

						$inventario = $resSelect->fetchall(PDO::FETCH_ASSOC); 

						echo json_encode($inventario,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE  | JSON_PARTIAL_OUTPUT_ON_ERROR); 

						fechaConexao();


				} catch (Exception $e) {
					print "Ocorreu um erro: <b style='color: red;>".$e3->getMessage."</b>"; 	
				}


		}
		
	}



?> 